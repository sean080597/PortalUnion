<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class CriterionType extends Model
{
    protected $fillable = [
        'content',
        'max_grade'
    ];
    public function critetions(){
        return $this->hasMany('app\Criterion');
    }
}