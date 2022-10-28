<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaranBala extends Model
{
    protected $table = 'karan_bala';

    protected $fillable = ['title', 'topic_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
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
