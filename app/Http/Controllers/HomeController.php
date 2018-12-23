<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ClassRoom;
use App\Student;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deniedaccess(){
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student == null){
            return view('errors.401');
        }else{
            $cur_classroom = ClassRoom::findOrFail($cur_student->class_room_id);
            return view('errors.401', ['cur_student' => $cur_student, 'cur_classroom' => $cur_classroom]);
        }
    }

    public function notfound(){
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student == null){
            return view('errors.404');
        }else{
            $cur_classroom = ClassRoom::findOrFail($cur_student->class_room_id);
            return view('errors.404', ['cur_student' => $cur_student, 'cur_classroom' => $cur_classroom]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student != null){
            $cur_classroom = ClassRoom::where('id', $cur_student->class_room_id)->first();
            return view('home', ['cur_student' => $cur_student, 'cur_classroom' => $cur_classroom]);
        }
        return view('home');
    }
}
