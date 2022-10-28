<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMeta extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'father_name', 'parent_phoneNumber', 'province', 'city',
        'unit', 'grade_id', 'birthday', 'identifier_id', 'identifying_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function identifier()
    {
        return $this->belongsTo($this, 'identifier_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}
