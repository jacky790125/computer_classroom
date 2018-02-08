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
        'stud_type_article_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function stud_type_article()
    {
        return $this->belongsTo(StudTypeArticle::class)->withDefault();
    }
}
