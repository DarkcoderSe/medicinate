<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Test extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function testQuestions(){
        return $this->hasMany(TestQuestion::class, 'test_id');
    }

    public function questions(){
        return $this->belongsToMany(Question::class, 'test_questions', 'test_id', 'question_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function testSubjectRules() {
        return $this->hasMany(TestSubjectRule::class, 'test_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'test_subject_rules', 'test_id', 'subject_id')->withPivot('percentage');
    }
}
