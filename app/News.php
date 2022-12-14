<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'body'];

    protected $table = 'news';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
