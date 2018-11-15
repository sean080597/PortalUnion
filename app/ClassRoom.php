<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id',
        'faculty_id'
    ];

    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }

    public function students(){
        return $this->hasMany('App\Student');
    }
}
