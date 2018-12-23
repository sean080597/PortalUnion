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
        return view('classrooms.index', ['cur_faculty' => $cur_faculty, 'classrooms' => $classrooms,
        'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2,
        'lsToShow_secs' => $lsToShow_secs
        ]);
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
}
