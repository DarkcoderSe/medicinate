<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectRule extends Model
{
    use HasFactory;

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
