<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appendices extends Model
{
    use SoftDeletes;

    protected $table = 'appendices';

    protected $fillable = ['title', 'book_id', 'type'];

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
