<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudTypeArticle extends Model
{
    protected $fillable = [
        'language',
        'title',
        'content'
    ];
}
