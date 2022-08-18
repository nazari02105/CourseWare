<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        "professor_id",
        "title",
        "question",
        "type",
        "options",
        "right_answer",
    ];

    public function professor (){
        return $this->belongsTo(Professor::class);
    }

    public function exams (){
        return $this->belongsToMany(Exam::class);
    }
}
