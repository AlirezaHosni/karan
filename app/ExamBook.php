<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamBook extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question', 'answerOne', 'answerTwo', 'answerThree',
        'answerFour','imageOne', 'imageTwo', 'imageThree',
        'imageFour', 'True', 'level', 'image', 'audio',
        'testable_type', 'testable_id', 'exam_id', 'parent_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function testable()
    {
        return $this->morphTo();
    }

    public function getTitleAttribute()
    {
        return $this->question;
    }
}
