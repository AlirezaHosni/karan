<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFile extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'file', 'type', 'format', 'description', 'section'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
