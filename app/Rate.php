<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'user_id', 'teacher_id', 'session_id', 'expert', 'teaching_method',
            'complete_teaching', 'question_answering_method', 'visual_communication', 'average'
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function session()
    {
        return $this->belongsTo(book::class, 'session_id');
    }
}
