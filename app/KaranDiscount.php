<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaranDiscount extends Model
{
    use SoftDeletes;
    
    protected $table = 'karan_discounts';

    protected $fillable = [
        'discount_code', 'percent', 'karan', 'discount_start_date',
        'discount_end_date', 'using_period_start_date', 'using_period_end_date'
    ];
}
