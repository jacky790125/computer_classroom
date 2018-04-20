<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskRecord extends Model
{
    protected $fillable = [
        'ask_course_id',
        'user_id',
        'play_date',
    ];
    public function ask_course()
    {
        return $this->belongsTo(AskCourse::class)->withDefault();
    }
}
