<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionSample extends Model
{
    protected $fillable = ['title', 'exam_question_sampleable_type', 'exam_question_sampleable_id', 'type', 'period'];

    public function examQuestionSampleable()
    {
        return $this->morphTo();
    }

    public function video()
    {
        return $this->morphOne(Video::class, 'videoable');
    }

    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }
}
