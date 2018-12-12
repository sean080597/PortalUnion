<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriteriaSelfregis extends Model
{
    protected $fillable = [
        'content',
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
