<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ClassRoom;
use App\Student;
use Auth;
use File;

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
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();
        return view('errors.401', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students]);
    }

    public function notfound(){
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();
        return view('errors.not_found', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = Role::create(['name' => 'administer']);
        // $role = Role::create(['name' => 'AccStudent']);
        // $role = Role::create(['name' => 'AccClass']);
        // $role = Role::create(['name' => 'AccFaculty']);
        // $role = Role::create(['name' => 'AccSchool']);

        // $permission = Permission::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'Adjust_Student']);
        // $permission = Permission::create(['name' => 'Adjust_Class']);
        // $permission = Permission::create(['name' => 'Adjust_Faculty']);
        // $permission = Permission::create(['name' => 'Evaluate_Class']);
        // $permission = Permission::create(['name' => 'Evaluate_Faculty']);
        // $permission = Permission::create(['name' => 'Evaluate_School']);
        // $permission = Permission::create(['name' => 'View_Faculty']);
        // $permission = Permission::create(['name' => 'View_School']);

        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->givePermissionTo($permission);
        // $permission->removeRole($role);
        // auth()->user()->assignRole('administer');
        // auth()->user()->givePermissionTo('admin');
        // return User::role('writer')->get();

        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student != null){
            $cur_classroom = ClassRoom::where('id', $cur_student->class_room_id)->first();
            return view('home', ['cur_student' => $cur_student, 'cur_classroom' => $cur_classroom]);
        }
        return view('home');
    }
}
