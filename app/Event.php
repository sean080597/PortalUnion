<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'link',
        'time_start',
        'num_day'
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
