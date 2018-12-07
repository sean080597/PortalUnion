<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_criteria_mandatory extends Model
{
    protected $fillable = [
        'student_id',
        'criterion_id',
        'self_assessment',
        'mark_student',
        'mark_classroom',
        'mark_faculty',
        'mark_school'
    ];
}
