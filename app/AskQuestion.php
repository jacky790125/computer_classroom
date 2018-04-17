<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskQuestion extends Model
{
    protected $fillable = [
        'ask_course_id',
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

    public function ask_course()
    {
        return $this->belongsTo(AskCourse::class)->withDefault();
    }
}
