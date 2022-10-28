<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'rate', 'resume'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(book::class, 'teacher_session','teacher_id', 'session_id');
    }
}
