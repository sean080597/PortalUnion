<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // $all_students = Student::all();
        // $all_classrooms = ClassRoom::all();
        // return view('home')->with(['all_students' => $all_students, 'all_classrooms' => $all_classrooms]);
        return view('home');
    }
}
