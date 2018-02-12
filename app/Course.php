<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
    ];

    public function course_questions()
    {
        return $this->hasMany(CourseQuestion::class);
    }
}
