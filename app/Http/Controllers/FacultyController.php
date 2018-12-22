<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\ClassRoom;
use App\Faculty;
use App\Student;
use App\Role;
use App\User;

class FacultyController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole'])
        ->except(['getlistfaculties', 'getInfoFaculty']);
    }

    public function getInfoFaculty(Request $request){
        $faculty = Faculty::findOrFail($request->fac_id);
        $msg = array();
        $msg['fac_name'] = $faculty->name;
        $msg['fac_note'] = $faculty->note;
        return $msg;
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
        $faculties = Faculty::orderby('name', 'asc')->get();
        $user_sec = User::where('role_id', 'sec')->first();
        $user_de1 = User::where('role_id', 'de1')->first();
        $user_de2 = User::where('role_id', 'de2')->first();
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        //ls users which is secretary, deputy secretary
        $ls_secs = $faculties->load('secretary');
        $lsToShow_secs = array();
        foreach($ls_secs as $key => $fa){
            $lsToShow_secs[$key] = User::where('id', $fa->uid_secretary)->first();
        }
        // dd($lsToShow_secs[1]->name);
        if($cur_student != null){
            $cur_classroom = ClassRoom::where('id', $cur_student->class_room_id)->first();
            return view('faculties.index', ['cur_classroom' => $cur_classroom,
            'cur_student' => $cur_student, 'faculties' => $faculties, 'lsToShow_secs' => $lsToShow_secs,
            'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2]);
        }
        return view('faculties.index', ['faculties' => $faculties, 'lsToShow_secs' => $lsToShow_secs,
        'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fac_id = $request->fac_id;
        $fac_name = $request->fac_name;
        $fac_note = $request->fac_note;

        $msg = array();
        if(Faculty::where('id', $fac_id)->count() > 0){
            $msg['error'] = 'Đã tồn tại khoa này';
        }else{
            Faculty::insert([
                'id' => $fac_id,
                'name' => $fac_name,
                'note' =>$fac_note,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $msg['success'] = 'Tạo khoa thành công';
        }
        return $msg;
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
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $old_faculty_id = $request->old_faculty_id;
        $new_faculty_name = $request->new_faculty_name;
        $new_faculty_id = $request->new_faculty_id;
        $new_faculty_note = $request->new_faculty_note;

        $msg = array();
        if($new_faculty_id == $old_faculty_id){
            $f = Faculty::findOrFail($old_faculty_id);
            $f->id = $new_faculty_id;
            $f->name = $new_faculty_name;
            $f->note = $new_faculty_note;
            $f->save();
            $msg['success'] = 'Sửa khoa thành công';
        }else{
            if(Faculty::where('id', $new_faculty_id)->count() > 0 ){
                $msg['error'] = 'Đã tồn tại khoa này';
            }else{
                $f = Faculty::findOrFail($old_faculty_id);
                $f->id = $new_faculty_id;
                $f->name = $new_faculty_name;
                $f->note = $new_faculty_note;
                $f->save();
                $msg['success'] = 'Sửa khoa thành công';
            }
        }
        return $msg;
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
