<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEvent extends Model
{
    protected $fillable = [
        'student_id',
        'event_id'
    ];
}
