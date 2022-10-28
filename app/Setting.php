<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'logo_text', 'agent_image', 'agent_text', 'pdfs', 'videos'
    ];

    protected $casts = ['pdfs' => 'array', 'videos' => 'array'];
}
