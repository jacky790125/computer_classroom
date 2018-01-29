<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudMoney extends Model
{
    protected $fillable = [
        'user_id',
        'thing',
        'thing_id',
        'stud_money',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
