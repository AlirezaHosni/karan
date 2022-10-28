<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTopic extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'topic_id'];

    protected $table = 'student_topic';

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
