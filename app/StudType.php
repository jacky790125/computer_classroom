<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudType extends Model
{
    protected $fillable = [
        'user_id',
        'right_count',
        'wrong_count',
        'no_type',
        'score',
        'timer',
        'article_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
