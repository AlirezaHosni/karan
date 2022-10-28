<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'image', 'book_id'];

    public function book()
    {
        return $this->belongsTo(book::class);
    }

    public function exams()
    {
        return $this->morphMany(Exam::class, 'examable');
    }


}
