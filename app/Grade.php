<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = ['id'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lastYear()
    {
        return $this->belongsTo($this, 'last_year_id');
    }

    public function nextYear()
    {
        return $this->hasMany($this, 'last_year_id');
    }

    public function users()
    {
        return $this->hasMany(UserMeta::class);
    }

    public static function allLessons(Grade $grade, array $result = [])
    {
        foreach ($grade->lessons as $lesson) {
            array_push($result, $lesson);
        }

        if ($grade->last_year_id != null){
           $result = Grade::allLessons($grade->lastYear, $result);
        }
        return $result;
    }

    public function gradeDescription()
    {
        return $this->hasOne(GradeDescription::class);
    }
}
