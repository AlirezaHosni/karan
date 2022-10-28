<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function books()
    {
        return $this->hasMany(book::class);
    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function tests()
    {
        return $this->morphMany(ExamBook::class, 'testable');
    }

    public function examQuestionSamples()
    {
        return $this->morphMany(ExamQuestionSample::class, 'examQuestionSampleable');
    }

    public function exam()
    {
        return $this->morphMany(Exam::class, 'examable');
    }
}
