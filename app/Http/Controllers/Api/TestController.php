<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Test;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\ConsumeCredit;

use App\Helpers\Madadgar;

use App\Repository\Test as TestRepo;

use Auth;
use Validator;
use Hash;
use DB;

class TestController extends Controller
{
    public $test;
    public function __construct(TestRepo $test) 
    {
        $this->test = $test;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'test_id' => 'numeric|required',
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
            //code...
            $test = Test::with('questions.options')
                        ->where('id', $request->test_id)
                        ->first();
            if(is_null($test))
                return response()->json([
                    'result' => 'Test Not found',
                    'response' => 'failed'
                ], 404);

            $currentCoins = Madadgar::coins();
            if($currentCoins < $test->required_coins)
                return response()->json([
                    'result' => 'You do not have enough coins to start this test',
                    'response' => 'failed'
                ], 404);

            $test->questions = $this->test->getQuestions($test->id);
            
            foreach($test->questions as $question){

                foreach($question->options as $key => $option){
                    if($question->correct_option == $option->id){
                        $question->correct_option = $key + 1;
                    }
                }
            }


            $result = new Result;
            $result->test_type = 0; // Uni-wise Test 
            $result->user_id = Auth::user()->id;
            $result->test_id = $test->id;
            $result->save();

            $consumeCredit = new ConsumeCredit;
            $consumeCredit->user_id = Auth::user()->id;
            $consumeCredit->result_id = $result->id;
            $consumeCredit->coins = $test->required_coins;
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
            'test' => $test,
            'result' => $result
        ], 200);

    }
}
