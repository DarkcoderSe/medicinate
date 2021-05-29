<?php 

namespace App\Helpers;

use App\Models\Result;
use App\Models\User;

class ResultCalculator
{
    public static function find($id){
        $result = Result::find($id); 

        $correctAns = 0;
        $wrongAns = 0;
        $skippedAns = 0;

        // dd($result->answeredQuestions);

        if(isset($result->answeredQuestions) && $result->answeredQuestions->count() == 0){
            return [
                'correct' => 0,
                'wrong' => 0,
                'skippedAns' => 0
            ];
        }

        $ansQs = $result->answeredQuestions ?? [];

        foreach($ansQs as $ansQ){
            $ansQ->question->options ?? [];
            
            // set number to correct option e.g 1,2,3,4
            foreach($ansQ->question->options as $key => $option){
                if($ansQ->question->correct_option == $option->id){
                    $ansQ->question->correct_option = $key + 1;
                }
            }

            // set number to selected option e.g 1,2,3,4
            foreach($ansQ->question->options as $key => $option){
                if($ansQ->sel_option_id == $option->id){
                    $ansQ->sel_option_id = $key + 1;
                }
            }

            if($ansQ->question->correct_option == $ansQ->sel_option_id)
                $correctAns += 1;
            elseif($ansQ->sel_option_id == null)
                $skippedAns += 1;
            else 
                $wrongAns += 1;

        }


        return [
            'answeredQuestions' => $ansQs,
            'correct' => $correctAns,
            'wrong' => $wrongAns,
            'skippedAns' => $skippedAns
        ];
    }
}