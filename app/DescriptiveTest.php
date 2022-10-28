<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptiveTest extends Model
{
    protected $guarded = ['id'];

//    public function book(){
//        return $this->belongsTo(book::class);
//    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function answers()
    {
        return $this->hasMany(DescriptiveAnswer::class, 'descriptive_test_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
