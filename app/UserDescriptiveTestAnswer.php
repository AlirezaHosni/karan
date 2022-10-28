<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDescriptiveTestAnswer extends Model
{
    use SoftDeletes;

    protected $table = 'user_descriptive_test_answers';

    protected $fillable = ['user_exam_answer_id', 'test_id', 'answer', 'score'];

    public function descriptiveTest()
    {
        return $this->belongsTo(DescriptiveTest::class, 'test_id');
    }

    public function userExamAnswer()
    {
        return $this->belongsTo(UserExamAnswer::class, 'user_exam_answer_id');
    }
}
