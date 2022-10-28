<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaranCompetitionAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['karan_competition_id', 'answer', 'image', 'is_true'];

    public function test()
    {
        return $this->belongsTo(KaranCompetition::class, 'karan_competition_id');
    }
}
