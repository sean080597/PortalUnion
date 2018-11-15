<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'phone',
        'job',
        'role'
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
