<?php

namespace App\Repository;

use App\Models\Question as Sawal;
use App\Models\QuestionOption as Option;

class Question 
{
    public function get($id = null)
    {
        $questions = Sawal::all();
        if(!is_null($id))
            $questions = Sawal::find($id);

        return $questions;
    }

    public function whereIn($attr, $val, $tmp) 
    {
        $questions = Sawal::whereIn($attr, $val)->take($tmp)->inRandomOrder()->get();
        return $questions;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $question = new Sawal;
        else 
            $question = Sawal::find($id);

        if (!is_null($request->chapId))
            $question->chapter_id = $request->chapId;
        $question->question = $request->question;
        $question->explaination = $request->explaination;
        $question->added_by = auth()->user()->id;
        $question->updated_by = auth()->user()->id;

        $question->save();
        return $question;
    }

    public function delete($id)
    {
        Sawal::destroy($id);
    }

    /**
     * Options
     */
    public function optionSave($request, $id = null) 
    {
        if (is_null($id)) 
            $opt = new Option;
        else 
            $opt = Option::find($id);

        if (!is_null($request->questionId))
            $opt->question_id = $request->questionId;

        $opt->value = $request->option;

        $opt->save();
        return $opt;
    }

    public function optionDelete($id)
    {
        Option::destroy($id);
    }

    public function updateCorrectOption($request) 
    {
        $question = Sawal::findOrFail($request->questionId);
        $question->correct_option = $request->optionId;
        $question->updated_by = auth()->user()->id;
        $question->save();
    }

}