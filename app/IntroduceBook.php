<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntroduceBook extends Model
{
    protected $fillable = ['lesson_id', 'type'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
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
