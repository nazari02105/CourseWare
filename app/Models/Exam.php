<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "builder_id",
        "course_id",
        "title",
        "description",
        "time",
    ];

    public function professor (){
        return $this->belongsTo(Professor::class, "builder_id", "id", "professors");
    }

    public function course (){
        return $this->belongsTo(Course::class);
    }

    public function questions (){
        return $this->belongsToMany(Question::class);
    }
}
