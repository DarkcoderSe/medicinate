<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DynamicTest;
use App\Models\DynamicTestChapter;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\ConsumeCredit;
use App\Models\Subject;

use App\Helpers\Madadgar;

use Auth;
use Validator;
use Hash;
use DB;

class DynamicTestController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'subject_id' => 'numeric|required',
            'total_questions' => 'numeric|required',
            'mode' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();
        try {

            $subject = Subject::findOrFail($request->subject_id);
            $currentCoins = Madadgar::coins();
            if($currentCoins < ($subject->coins_per_question * $request->total_questions))
                return response()->json([
                    'result' => 'You do not have enough coins to start this test',
                    'response' => 'failed'
                ], 404);

            //code...
            $dynamicTest = new DynamicTest;
            $dynamicTest->subject_id = $request->subject_id;
            $dynamicTest->user_id = Auth::user()->id;
            $dynamicTest->total_questions = $request->total_questions;
            $dynamicTest->mode = $request->mode;
            $dynamicTest->save();

            $coinCharge = 0;

            if(count($request->chapter_ids)){
                foreach($request->chapter_ids as $chapId){
                    $dtChapter = new DynamicTestChapter;
                    $dtChapter->dyn_test_id = $dynamicTest->id;
                    $dtChapter->chapter_id = $chapId;
                    $dtChapter->save();

                
                }
            }

            $questions = Question::whereIn('chapter_id', $request->chapter_ids)
                                    ->with('options')
                                    ->inRandomOrder()
                                    ->take($request->total_questions)
                                    ->get();
            
            foreach($questions as $question){

                foreach($question->options as $key => $option){
                    if($question->correct_option == $option->id){
                        $question->correct_option = $key + 1;
                    }
                }
            }

            $coinCharge += ($questions->count() * $subject->coins_per_question);
        
            $result = new Result;
            $result->test_type = 1; // Dynamic Test 
            $result->user_id = Auth::user()->id;
            $result->test_id = $dynamicTest->id;
            $result->save();

            $consumeCredit = new ConsumeCredit;
            $consumeCredit->user_id = Auth::user()->id;
            $consumeCredit->result_id = $result->id;
            $consumeCredit->coins = $coinCharge;
            $consumeCredit->save();

        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();

            return response()->json([
                'response' => 'failed'
            ], 404);
        }
        DB::commit();

        return response()->json([
            'response' => 'success',
            'questions' => $questions,
            'test' => $dynamicTest,
            'result' => $result
        ], 200);

    }
}
