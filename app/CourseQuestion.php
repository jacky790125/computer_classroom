<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseQuestion extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'title_img',
        'ans_A',
        'ans_A_img',
        'ans_B',
        'ans_B_img',
        'ans_C',
        'ans_C_img',
        'ans_D',
        'ans_D_img',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
}
