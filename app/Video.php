<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'video', 'videoable_type', 'videoable_id', 'status', 'type'];

    public function videoable()
    {
        return $this->morphTo();
    }

    public static function getRoute($type){
        if($type == 1)
            return 'book.index';
        elseif($type == 2)
            return 'examBook.index';
        elseif($type == 3)
            return 'examBook.index';
        else
            return 'textBook.index';
    }

}
