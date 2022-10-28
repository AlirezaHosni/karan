<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPackSale extends Model
{
    protected $fillable = [
        'grade_id', 'lesson_id', 'session_id', 'grade_price',
        'lesson_price', 'session_price', 'flash_capacity',
        'flash_price', 'dvd_capacity', 'dvd_price'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function session()
    {
        return $this->belongsTo(book::class, 'session_id');
    }
}
