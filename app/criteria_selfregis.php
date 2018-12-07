<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class criteria_selfregis extends Model
{
    protected $fillable = [
        'content',
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
