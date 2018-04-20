<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'semester',
        'type',
        'title',
        'description',
        'for',
        'close',
    ];
    public function student_tasks()
    {
        return $this->hasMany(StudentTask::class);
    }
}
