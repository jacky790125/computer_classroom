<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudType extends Model
{
    protected $fillable = [
        'user_id',
        'rightcount',
        'wrongcount',
        'notype',
        'score',
        'timer',
        'article_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
