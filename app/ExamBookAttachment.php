<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamBookAttachment extends Model
{
    protected $table = 'exam_book_attachments';

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
