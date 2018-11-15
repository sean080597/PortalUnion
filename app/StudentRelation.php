<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRelation extends Model
{
    protected $fillable = [
        'student_id',
        'ralation_id'
    ];
}
