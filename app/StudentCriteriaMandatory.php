<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCriteriaMandatory extends Model
{
    protected $fillable = [
        'student_id',
        'criteria_id',
        'self_assessment',
        'mark_student',
        'mark_classroom',
        'mark_faculty',
        'mark_school'
    ];
}
