<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCriterion extends Model
{
    protected $fillable = [
        'student_id',
        'criterion_id',
        'grade'
    ];
}
