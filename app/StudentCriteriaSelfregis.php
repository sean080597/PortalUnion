<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCriteriaSelfregis extends Model
{
    protected $fillable = [
        'student_id',
        'criteria_id',
        'content_regis',
        'self_assessment',
        'mark_student',
        'mark_classroom',
        'mark_faculty',
        'mark_school'
    ];
}
