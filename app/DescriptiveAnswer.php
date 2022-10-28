<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptiveAnswer extends Model
{
    protected $fillable = ['descriptive_test_id', 'body', 'number', 'score', 'image'];

    public function question()
    {
        return $this->belongsTo(DescriptiveTest::class, 'descriptive_test_id');
    }
}
