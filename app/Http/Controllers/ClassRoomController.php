<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ClassRoom;
use App\Faculty;
use App\Student;

use Carbon\Carbon;
use Auth;

class ClassRoomController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole']);
    }

    public function addnewclassroom(Request $request)
    {
        $new_classname = $request->new_classname;
        $faculty_id = $request->faculty_id;

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

    public function getselfaculties(Request $request){
        $all_faculties = Faculty::orderby('name', 'asc')->get();

        $opts = '';
        if(!empty($request->classroom_id)){
            foreach($all_faculties as $faculty){
                $opts .= '<option value="'.$faculty->id.'" '.((($faculty->id) == ($request->faculty_id)) ? "selected" : "").'>'.$faculty->name.(!empty($faculty->note)?' ( '.$faculty->note.' )':'').'</option>';
            }
        }else{
            foreach($all_faculties as $faculty){
                $opts .= '<option value="'.$faculty->id.'">'.$faculty->name.(!empty($faculty->note)?' ( '.$faculty->note.' )':'').'</option>';
            }
        }

        $result = '<form id="form_add_new_classroom">
            <label for="add_new_classroom_name" class="mr-sm-2">Tên Lớp:</label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="add_new_classroom_name" maxlength="10" placeholder="Nhập tên lớp" value="'.$request->classroom_id.'">
            <strong id="error_add_new_classname" style="color:red; display:none"></strong>
            <label for="choose_faculty_for_new_classroom" class="mr-sm-2">Khoa / Viện:</label>
            <select class="form-control" name="choose_faculty_for_new_classroom" id="choose_faculty_for_new_classroom">
                <option value="0" disabled selected>=== Chọn Khoa / Viện ===</option>
                '.$opts.'
            </select>
        </form>';
        return response()->json($result);
    }

    public function getlistclassrooms(Request $request){
        $all_classrooms = ClassRoom::where('faculty_id', '=', $request->faculty_id)->orderby('id', 'asc')->get();
        return response()->json($all_classrooms);
    }

    public function manage(Request $request)
    {
        $all_faculties = Faculty::orderby('name', 'asc')->get();
        $all_students = Student::all();//can remove
        $all_classrooms = ClassRoom::all();//can remove
        return view('classrooms.manage', ['all_classrooms' => $all_classrooms, 'all_students' => $all_students, 'all_faculties' => $all_faculties]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($faculty_id)
    {
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();
        $classrooms = ClassRoom::where('faculty_id', $faculty_id)->get();

        return view('classrooms.index', ['faculty_id' => $faculty_id, 'classrooms' => $classrooms, 'all_classrooms' => $all_classrooms, 'all_students' => $all_students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $classRoom = ClassRoom::findOrFail($classRoom->id);
        return view('classrooms.edit', compact('classRoom'));
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
        $old_classname = $request->old_classname;
        $new_classname = $request->new_classname;
        $faculty_id = $request->faculty_id;

        $msg = array();
        if($new_classname == $old_classname){
            $c = ClassRoom::findOrFail($old_classname);
            $c->faculty_id = $faculty_id;
            $c->save();
            $msg['success'] = 'Sửa lớp thành công';
        }else{
            if(ClassRoom::where('id', $new_classname)->count() > 0 ){
                $msg['error'] = 'Đã tồn tại lớp này';
            }else{
                $c = ClassRoom::findOrFail($old_classname);
                $c->id = $new_classname;
                $c->faculty_id = $faculty_id;
                $c->save();
                $msg['success'] = 'Sửa lớp thành công';
            }
        }
        return $msg;
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
        return 'ClassRoom with name - '.$request->classroom_id.' has been deleted';
    }
}
