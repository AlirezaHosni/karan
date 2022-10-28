<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'document', 'documentable_type', 'documentable_id', 'status', 'type'];

    public function documentable()
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
