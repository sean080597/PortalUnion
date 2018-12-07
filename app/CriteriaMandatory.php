<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriteriaMandatory extends Model
{
    protected $fillable = [
        'content',
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }
}
