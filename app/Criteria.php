<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $fillable = [
        'content',
        'max_grade',
    ];

    public function criterion_type(){
        return $this->belongsTo('App\CriterionType');
    }

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
