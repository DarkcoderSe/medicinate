<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\QuestionAnswer;
use Auth;
use App\Models\Result;

use App\Helpers\ResultCalculator as RC;
use App\Helpers\Badger;

class ResultController extends Controller
{
    public function index($resultId){
        try {
            Badger::assign();
            $score = RC::find($resultId);

        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json([
            'score' => $score,
            'response' => 'success'
        ], 200);
    }

    public function answerMcq(Request $request){
        $mcqCheck = QuestionAnswer::where('user_id', $request->user_id)
                                ->where('question_id', $request->question_id)
                                ->where('result_id', $request->result_id)
                                ->first();
        if(is_null($mcqCheck)){
            $mcq = new QuestionAnswer;
            $mcq->question_id = $request->question_id;
            $mcq->user_id = $request->user_id;
            $mcq->result_id = $request->result_id;
            $mcq->sel_option_id = $request->sel_option_id ?? null;
            $mcq->time_spent = $request->time_spent;
            $mcq->save();
        }
        else{
            $mcqCheck->time_spent += $request->time_spent;
            $mcqCheck->sel_option_id = $request->sel_option_id ?? null;
            $mcqCheck->save();
        }

        return response()->json([
            'response' => 'success'
        ], 200);
    }

    public function userResult(){
        $user = Auth::user();
        $results = $user->results;
        foreach($results as $result){
            $test = $result->generalTest->name 
                        ?? (($result->dynamicTest ? $result->dynamicTest->subject->name : '') . ' Dynamic Test' ?? ' Dynamic Test');
            $result->test = $test;
            $score = RC::find($result->id);
            $result->score = $score;
        }

        return response()->json([
            'results' => $results,
            'response' => 'success'
        ], 200);
    }

    public function results(){
        $results = Result::with('user')->get();
        foreach($results as $result){
            $score = RC::find($result->id);
            $result->score = $score;
            // $result->user = $result->user->name ?? '';

        }

        return response()->json([
            'results' => $results,
            'response' => 'success'
        ], 200);
    }
}
