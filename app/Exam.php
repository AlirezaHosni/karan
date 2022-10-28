<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'number', 'section', 'questionFormat', 'type',
        'scheduling', 'examable_type', 'examable_id',
        'suggestedTime', 'start_at', 'level', 'period', 'answerSheet'
    ];

    public function examable()
    {
        return $this->morphTo();
    }

    public function tests()
    {
        return $this->hasMany(ExamBook::class);
    }

    public function descriptiveTests()
    {
        return $this->hasMany(DescriptiveTest::class);
    }
}
