<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Category extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function childs(){
        return $this->hasMany(Category::class, 'parent_id')->with('tests');
    }

    public function allChilds(){
        return $this->childs()->with('childs')->with('tests');
    }

    public function tests(){
        return $this->hasMany(Test::class, 'category_id');
    }
}
