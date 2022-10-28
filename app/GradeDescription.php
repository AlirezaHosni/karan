<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeDescription extends Model
{
    protected $fillable = ['description', 'selected_lesson_id', 'image', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function selectedLesson()
    {
        return $this->belongsTo(Lesson::class, 'selected_lesson_id');
    }
}
