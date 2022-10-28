<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSession extends Model
{
    use SoftDeletes;

    protected $table = 'teacher_session';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function session()
    {
        return $this->belongsTo(book::class, 'session_id');
    }
}
