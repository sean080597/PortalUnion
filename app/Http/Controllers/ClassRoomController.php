<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\ClassRoom;
use App\Faculty;
use App\Student;
use App\User;

class ClassRoomController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole'])
        ->except(['getlistclassrooms', 'get_sel_faculties', 'add_new_classroom',
        'getPaginateClassrooms']);
    }

    public function manage(Request $request)
    {
        $classrooms = Faculty::select('faculties.name', 'class_rooms.id',
        'class_rooms.faculty_id', 'class_rooms.updated_at')
        ->join('class_rooms', 'class_rooms.faculty_id', '=', 'faculties.id')
        ->orderBy('class_rooms.id', 'ASC')
        ->paginate(20);
        return view('classrooms.manage', ['classrooms' => $classrooms]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $faculty_id)
    {
        //$cur_faculty to get all info in blade view
        $cur_faculty = Faculty::findOrFail($faculty_id);
        $user_sec = User::where('id', $cur_faculty->uid_secretary)->first();
        $user_de1 = User::where('id', $cur_faculty->uid_deputysecre1)->first();
        $user_de2 = User::where('id', $cur_faculty->uid_deputysecre2)->first();

        $classrooms = ClassRoom::where('faculty_id', $faculty_id)->paginate(20);
        $lsToShow_secs = array();
        foreach($classrooms as $key => $cla){
            $lsToShow_secs[$key] = User::where('id', $cla->uid_secretary)->first();
        }
        //get current student if exists
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student == null){
            return view('classrooms.index', ['cur_faculty' => $cur_faculty, 'classrooms' => $classrooms,
            'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2,
            'lsToShow_secs' => $lsToShow_secs
            ]);
        }else{
            $cur_classroom = ClassRoom::findOrfail($cur_student->class_room_id);
            return view('classrooms.index', ['cur_faculty' => $cur_faculty, 'classrooms' => $classrooms,
            'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2,
            'lsToShow_secs' => $lsToShow_secs, 'cur_student' => $cur_student,
            'cur_classroom' => $cur_classroom
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $new_classname = $request->new_classname;
        $faculty_id = strtoupper($request->faculty_id);

        $msg = array();
        if(ClassRoom::where('id', $new_classname)->count() > 0){
            $msg['error'] = 'Đã tồn tại lớp này';
        }else{
            ClassRoom::insert([
                'id' => $new_classname,
                'faculty_id' => $faculty_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $msg['success'] = 'Tạo lớp thành công';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $classroom_id = $request->classroom_id;
        $faculty_id = $request->faculty_id;

        $c = ClassRoom::findOrFail($classroom_id);
        $c->faculty_id = $faculty_id;
        $c->save();
        return  'Sửa lớp thành công';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $classRoom = ClassRoom::findOrFail($request->classroom_id);
        $classRoom->delete();
        return 'Đã xóa thành công lớp: '.$request->classroom_id;
    }

    //getPaginateClassrooms
    public function getPaginateClassrooms(Request $request)
    {
        if($request->ajax()){
            $faculty_id = $request->get('faculty_id');
            $query = $request->get('query');
            if($query != null){
                $classrooms = ClassRoom::where('id', 'like', '%'.$query.'%')
                ->Where('faculty_id', $faculty_id)->paginate(20);
                $lsToShow_secs = array();
                foreach($classrooms as $key => $cla){
                    $lsToShow_secs[$key] = User::where('id', $cla->uid_secretary)->first();
                }
            }else{
                $classrooms = ClassRoom::where('faculty_id', $request->faculty_id)->paginate(20);
                $lsToShow_secs = array();
                foreach($classrooms as $key => $cla){
                    $lsToShow_secs[$key] = User::where('id', $cla->uid_secretary)->first();
                }
            }
            $total_row = $classrooms->total();
            return view('partials.pagination_classrooms', compact(['classrooms', 'faculty_id',
            'lsToShow_secs', 'total_row']))
            ->render();
        }
    }

    //getPaginateClassrooms to manage
    public function getPaginateClassroomsManage(Request $request){
        if($request->ajax()){
            $query = $request->get('query');
            if($query != null){
                $classrooms = Faculty::select('faculties.name', 'class_rooms.id',
                'class_rooms.faculty_id', 'class_rooms.updated_at')
                ->join('class_rooms', 'class_rooms.faculty_id', '=', 'faculties.id')
                ->orderBy('class_rooms.id', 'ASC')
                ->where('faculties.name', 'like', '%'.$query.'%')
                ->orWhere('class_rooms.id', 'like', '%'.$query.'%')
                ->orWhere('class_rooms.faculty_id', 'like', '%'.$query.'%')
                ->paginate(20);
            }else{
                $classrooms = Faculty::select('faculties.name', 'class_rooms.id',
                'class_rooms.faculty_id', 'class_rooms.updated_at')
                ->join('class_rooms', 'class_rooms.faculty_id', '=', 'faculties.id')
                ->orderBy('class_rooms.id', 'ASC')
                ->paginate(20);
            }
            $total_row = $classrooms->total();
            return view('partials.pagination_classrooms_manage', compact(['classrooms', 'total_row']))
            ->render();
        }
    }

    //getSelFaculties
    public function getSelFaculties(Request $request)
    {
        $faculty_id = $request->faculty_id;
        if($faculty_id == null){
            $faculties = Faculty::orderBy('name', 'ASC')->get();
            return view('partials.sel_option_faculties', compact(['faculties']))->render();
        }else{
            $faculties = Faculty::orderBy('name', 'ASC')->get();
            return view('partials.sel_option_faculties', compact(['faculties', 'faculty_id']))->render();
        }
    }
}
