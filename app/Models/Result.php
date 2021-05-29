<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'test_type',
        'user_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function dynamicTest(){
        return $this->belongsTo(DynamicTest::class, 'test_id');
    }

    public function generalTest(){
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answeredQuestions(){
        return $this->hasMany(QuestionAnswer::class, 'result_id');
    }

  
}
