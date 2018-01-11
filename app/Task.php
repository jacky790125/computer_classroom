<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'for',
    ];
    public function student_tasks()
    {
        return $this->hasMany(StudentTask::class);
    }
}
