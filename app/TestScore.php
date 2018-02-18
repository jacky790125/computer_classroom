<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    protected $fillable = [
        'test_id',
        'user_id',
        'answers',
        'total_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function test()
    {
        return $this->belongsTo(Test::class)->withDefault();
    }
}
