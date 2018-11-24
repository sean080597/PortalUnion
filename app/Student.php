<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
        'name',
        'address',
        'sex',
        'birthday',
        'phone',
        'hometown',
        'ethnic',
        'religion',
        'union_date',
        'is_submit',
    ];

    public function classroom(){
        return $this->belongsTo('App\ClassRoom');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function relations(){
        return $this->belongsToMany('App\Relation');
    }

    public function events(){
        return $this->belongsToMany('App\Event');
    }

    public function criterions(){
        return $this->belongsToMany('App\Criterion');
    }
}
