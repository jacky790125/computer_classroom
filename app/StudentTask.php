<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    protected $fillable = [
        'semester',
        'task_id',
        'user_id',
        'year_class_num',
        'report',
        'score',
        'saying',
        'public',
        'views',
        'likes',
        'to_money',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class)->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
