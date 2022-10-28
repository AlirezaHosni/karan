<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionSale extends Model
{
    protected $fillable = [
        'type', 'lesson_id', 'first_term_price',
        'second_term_price', 'year_price'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
