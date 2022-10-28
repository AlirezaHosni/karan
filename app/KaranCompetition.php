<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaranCompetition extends Model
{
    use SoftDeletes;

    protected $fillable = ['question', 'image', 'karan_number', 'grade_id', 'time'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function answers()
    {
        return $this->hasMany(KaranCompetitionAnswer::class, 'karan_competition_id');
    }

    public function answerAttribute()
    {
        return $this->answers()->where('is_true', 1)->first();
    }
}
