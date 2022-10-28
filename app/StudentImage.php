<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentImage extends Model
{
    use SoftDeletes;

    protected $fillable = ['image'];
}
