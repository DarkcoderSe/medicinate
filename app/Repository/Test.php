<?php

namespace App\Repository;

use App\Models\Test as TestModel;
use App\Models\TestQuestion;
use App\Models\TestSubjectRule;

use App\Repository\Subject;
use App\Repository\Question;

class Test 
{
    public $subject;
    public $question;

    public function __construct(Subject $subject, Question $question)
    {
        $this->subject = $subject;
        $this->question = $question;
    }

    public function get($id = null)
    {
        $tests = TestModel::all();
        if(!is_null($id))
            $tests = TestModel::find($id);

        return $tests;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $test = new TestModel;
        else 
            $test = TestModel::find($id);

        if (!is_null($request->categoryId))
            $test->category_id = $request->categoryId;

        $test->added_by = auth()->user()->id;
        $test->name = $request->name;
        $test->slug = $request->slug;
        $test->required_time = $request->requiredTime;
        $test->required_coins = $request->requiredCoins;
        $test->type = $request->type == 'on' ? 1 : 0;
        $test->total_questions = $request->totalQuestions;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $name = 'test_' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/images/tests');
            $image->move($destinationPath, $name);
            $test->image = $name;   
        }

        $test->save();

        return $test;
    }

    public function delete($id)
    {
        TestModel::destroy($id);
    }

    /**
     * Questions
     */
    public function questionDelete($tId, $qId) 
    {
        TestQuestion::where('test_id', $tId)->where('question_id', $qId)->delete();
    }

    public function addQuestionToTest($request) 
    {
        $test = TestModel::find($request->testId);
        foreach($request->subject as $subjectId => $percentage) {
            $temp = ($percentage / 100) * $request->totalQuestions;

            $subject = $this->subject->get($subjectId);
            $chapterIds = [];
            foreach($subject->chapters as $chap) {
                $chapterIds[] = $chap->id;
            }

            $questions = $this->question->whereIn('chapter_id', $chapterIds, $temp);
            foreach($questions as $question) {
                $testQuestion = new TestQuestion;
                $testQuestion->test_id = $request->testId;
                $testQuestion->question_id = $question->id;
                $testQuestion->save();
            }

            
        }
    }

    public function addTestSubjectRules($request) 
    {
        foreach ($request->subject as $subjectId => $percentage) {
            $testSubjectRule = new TestSubjectRule;
            $testSubjectRule->test_id = $request->testId;
            $testSubjectRule->subject_id = $subjectId;
            $testSubjectRule->percentage = $percentage;
            $testSubjectRule->save();
        }
    }

    public function deleteTestSubjectRule($id)
    {
        TestSubjectRule::destroy($id);
    }

    /**
     * Getting test question based on subject wise rules 
     */
    public function getQuestions($testId)
    {   
        $allQuestions = collect();
        $test = TestModel::with('subjects.chapters')->find($testId);
        foreach($test->subjects as $subject) {
            $chapIds = [];
            $limit = ($subject->pivot->percentage / 100) * $test->total_questions;

            foreach($subject->chapters as $chapter) {
                $chapIds[] = $chapter->id;
            }

            $questions = $this->question->whereIn('chapter_id', $chapIds, $limit);
            $allQuestions = $allQuestions->merge($questions);
        }

        return $allQuestions;
        // dd(\array_rand($chapIds));
    }
    
}