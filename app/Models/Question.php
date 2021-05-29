<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Question extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function options(){
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'added_by');
    }
}
