<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $guarded = ['id'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function examBooks()
    {
        return $this->hasMany(ExamBook::class);
    }

    public function DescriptiveTests()
    {
        return $this->hasMany(DescriptiveTest::class);
    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function getTitleAttribute()
    {
        return $this->session . '-' . $this->part;
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function appendices()
    {
        return $this->hasMany(Appendices::class);
    }

    public function tests()
    {
        return $this->morphMany(ExamBook::class, 'testable');
    }

    public function examQuestionSamples()
    {
        return $this->morphMany(ExamQuestionSample::class, 'examQuestionSampleable');
    }

    public function exam_question_samples()
    {
        return $this->hasMany(ExamQuestionSample::class);
    }

    public function getSessionBookAttribute()
    {
        return book::where('part', null)->where('session', 'like', $this->session)->first();
    }

    public function getPartsBookAttribute()
    {
        return book::whereNotNull('part')->where('session', 'like', $this->session)->get();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_session', 'session_id', 'teacher_id');
    }

}
