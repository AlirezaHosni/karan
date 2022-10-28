<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'logout_at', 'interval'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
