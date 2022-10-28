<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextBook extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'topic_id'];

    public function video()
    {
        return $this->morphOne(Video::class, 'videoable');
    }

    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
