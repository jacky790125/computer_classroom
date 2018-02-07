<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discuss extends Model
{
    protected $fillable = [
        'title',
        'content',
        'depend_on',
        'views',
        'reply',
        'bad',
        'say_bad',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
