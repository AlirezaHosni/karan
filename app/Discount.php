<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'discount_code', 'percent', 'type', 'discount_start_date',
        'discount_end_date', 'using_period_start_date',
        'using_period_end_date', 'identifier_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'identifier_id');
    }
}
