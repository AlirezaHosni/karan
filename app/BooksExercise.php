<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksExercise extends Model
{
    protected $table = 'books_exercises';

    protected $fillable = ['title', 'book_id'];

    public function book()
    {
        return $this->belongsTo(book::class);
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
