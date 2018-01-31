<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudMessage extends Model
{
    protected $fillable = [
        'title',
        'content',
        'from',
        'to',
        'read',
        'ip',
    ];
}
