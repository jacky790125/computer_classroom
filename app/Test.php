<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'semester'.
        'title',
        'for',
        'score',
        'enable',
        'questions'
    ];
}
