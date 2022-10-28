<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExamAnswer extends Model
{
    use SoftDeletes;

    protected $table = 'user_exam_answers';

    protected $fillable = ['exam_id', 'user_id', 'score'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userTestAnswers()
    {
        return $this->hasMany(UserTestAnswer::class, 'user_exam_answer_id');
    }

    public function userDescriptiveTestAnswers()
    {
        return $this->belongsTo(UserDescriptiveTestAnswer::class, 'user_exam_answer_id');
    }
}
