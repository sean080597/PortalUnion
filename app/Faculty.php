<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Faculty extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'note'
    ];
    public function classrooms(){
        return $this->hasMany('App\ClassRoom');
    }
}