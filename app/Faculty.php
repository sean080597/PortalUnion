<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Faculty extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'note',
        'uid_secretary',
        'uid_deputysecre1',
        'uid_deputysecre2'
    ];
    public function classrooms(){
        return $this->hasMany('App\ClassRoom');
    }

    public function secretary(){
        return $this->belongsTo('App\User');
    }

    public function deputySecretary1(){
        return $this->belongsTo('App\User');
    }

    public function deputySecretary2(){
        return $this->belongsTo('App\User');
    }
}