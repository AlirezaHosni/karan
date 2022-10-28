<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamDiscount extends Model
{
    protected $fillable = [
        'discount_percent', 'discount_start_date',
        'discount_end_date', 'exam_id', 'price'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
