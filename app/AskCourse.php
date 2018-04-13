<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskCourse extends Model
{
    protected $fillable = [
        'name',
    ];

    public function ask_questions()
    {
        return $this->hasMany(AskQuestion::class);
    }
}
