<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Faculty;
use App\Student;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function getlistfaculties(){
        $all_faculties = Faculty::orderby('name', 'asc')->get();
        return response()->json($all_faculties);
    }

    public function manage() {
        $faculties = Faculty::orderby('name', 'asc')->get();
        $all_classrooms = ClassRoom::all();//
        $all_students = Student::all();//can remove after assign permissions
        return view('faculties.manage', ['faculties' => $faculties, 'all_classrooms' => $all_classrooms, 'all_students' => $all_students]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();
        $faculties = Faculty::orderby('name', 'asc')->get();
        return view('faculties.index', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students, 'faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_classrooms = ClassRoom::all();//
        $all_students = Student::all();//can remove after assign permissions
        return view('faculties.create', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|max:4',
            'name' =>'required|max:50',
        ]);

        if(Faculty::where('id', $request->input('id'))->count() > 0){
            return redirect()->back()->withErrors('Trùng lặp mã khoa!');
        }

        $id = $request['faculty_id'];
        $name = $request['name'];
        $faculty = Faculty::create($request->only('id', 'name'));

        //Display a successful message upon save
        return redirect()->route('faculties.manage')
            ->with('flash_message', 'Id - '. $faculty->id.' Name - '.$faculty->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_classrooms = ClassRoom::all();//
        $all_students = Student::all();//can remove after assign permissions
        $faculty = Faculty::findOrFail($id);
        return view('faculties.edit', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students, 'faculty' => $faculty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id'=>'required|max:4',
            'name' =>'required|max:50',
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->id = $request->input('id');
        $faculty->name = $request->input('name');
        $faculty->save();

        return redirect()->route('faculties.manage',
            $faculty->id)->with('flash_message',
            'Id - '. $faculty->id.' Name - '.$faculty->name.' created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faculty = Faculty::findOrFail($request->faculty_id);
        $faculty->delete();
        return 'Faculty with name - '.$request->faculty_id.' has been deleted';
    }
}
