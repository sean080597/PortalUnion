<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use Carbon\Carbon;
use Auth;
use DB;

use App\Student;
use App\ClassRoom;
use App\Faculty;
use App\Relation;
use App\StudentRelation;
use App\User;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole'])->except(['getMoreStudents', 'update',
        'ajaxupload', 'getPaginateStudents']);
    }

    public function getMoreStudents(Request $request){
        if($request->stt_student == DB::table('students')->count()){
            return null;
        }
        $next_students = [];
        $all_faculties = Faculty::all();
        $all_classrooms = ClassRoom::all();

        $splice_students = Student::all()->splice($request->stt_student);
        $splice_students = $splice_students->take(10);

        $result = '';
        foreach ($splice_students as $student){
            $result .= '<tr><td class="text-center"><input type="checkbox"></td>'
                    .'<td class="text-center">'.++$request->stt_student.'</td>'
                    .'<td>'.$student->id.'</td>'
                    .'<td>'.$student->name.'</td>'
                    .'<td>'.$student->class_room_id.'</td>'
                    .'<td>'.Faculty::where('id', ClassRoom::where('id', $student->class_room_id)->first()->faculty_id)->first()->name.'</td>'
                    .'<td class="text-center"><a href="/students/show/'.$student->id.'" class="text-secondary"><i class="fas fa-eye"></i></a></td>'
                    .'<td class="text-center"><a href="#" class="text-primary"><i class="fas fa-user-edit"></i></a></td>'
                    .'<td class="text-center"><a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a></td></tr>';
        }
        return $result;
    }

    public function manageshow($student_id)
    {
        $all_faculties = Faculty::all();
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();

        //get student
        $student = Student::findOrFail($student_id);
        $user = User::where('id', $student->user_id)->first();

        //get classroom & faculty
        $class = ClassRoom::findOrFail($student->class_room_id);
        $faculty = Faculty::findOrFail($class->faculty_id);

        //get relations
        $list_relation = StudentRelation::where('student_id', $student_id)->get();
        $dad = $mom = '';
        foreach($list_relation as $item){
            $relation = Relation::findOrFail($item->relation_id);
            if($relation->role == 1){
                $dad = $relation;
            }else{
                $mom = $relation;
            }
        }

        return view('students.manageshow', ['student' => $student, 'all_faculties' => $all_faculties, 'all_classrooms' => $all_classrooms, 'all_students' => $all_students, 'user' => $user, 'faculty' => $faculty, 'dad' => $dad, 'mom' => $mom]);
    }

    public function manage()
    {
        $students = Student::select('students.id', 'students.name', 'students.class_room_id',
        'students.created_at', 'faculties.name as faculty_name')
        ->join('class_rooms', 'class_rooms.id', '=', 'students.class_room_id')
        ->join('faculties', 'faculties.id', '=', 'class_rooms.faculty_id')
        ->orderBy('students.class_room_id', 'ASC')
        ->paginate(40);
        return view('students.manage', ['students' => $students]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($faculty_id, $classroom_id)
    {
        $cur_classroom = ClassRoom::findOrFail($classroom_id);
        $user_sec = User::where('id', $cur_classroom->uid_secretary)->first();
        $user_de1 = User::where('id', $cur_classroom->uid_deputysecre1)->first();
        $user_de2 = User::where('id', $cur_classroom->uid_deputysecre2)->first();

        //get list of students & paginate
        $students = Student::where('class_room_id', $classroom_id)->paginate(20);

        //get current student if exists
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        if($cur_student == null){
            return view('students.index', ['cur_classroom' => $cur_classroom, 'students' => $students,
            'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2,
            ]);
        }else{
            return view('students.index', ['cur_classroom' => $cur_classroom, 'students' => $students,
            'user_sec' => $user_sec, 'user_de1' => $user_de1, 'user_de2' => $user_de2,
            'cur_student' => $cur_student
            ]);
        }
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        //get student
        $cur_student = Student::findOrFail($student_id);
        $cur_user = User::where('id', $cur_student->user_id)->first();

        //get classroom & faculty
        $cur_classroom = ClassRoom::findOrFail($cur_student->class_room_id);
        $cur_faculty = Faculty::findOrFail($cur_classroom->faculty_id);

        //get relations
        $list_relation = StudentRelation::where('student_id', $student_id)->get();
        $dad = $mom = '';
        foreach($list_relation as $item){
            $relation = Relation::findOrFail($item->relation_id);
            if($relation->role == 1){
                $dad = $relation;
            }else{
                $mom = $relation;
            }
        }

        return view('students.show', ['cur_student' => $cur_student,
        'cur_classroom' => $cur_classroom, 'cur_faculty' => $cur_faculty,
        'cur_user' => $cur_user, 'dad' => $dad, 'mom' => $mom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // get info to update table students
        $student = Student::findOrFail($request->student_id);
        //check if in manage student
        if(!empty($request->name)){
            $student->name = $request->name;
            $student->birthday = $request->birthday;
            $student->class_room_id = $request->class_room;
        }
        $student->address = $request->address;
        $student->sex = $request->sex;
        $student->hometown = $request->hometown;
        $student->union_date = $request->union_day;
        $student->ethnic = $request->ethnic;
        $student->religion = $request->religion;
        $student->save();

        //get info to update table users
        $user = User::findOrFail($request->user_id);
        if(!empty($request->phonenum)){
            $user->phone = $request->phonenum;
        }
        $user->email = $request->email;
        $user->save();

        // //get info to update table relations
        if(!empty($request->father_name)){
            $dad_name = $request->father_name;
        }else{
            $dad_name = '';
        }
        $dad_birthday = $request->father_birthday;
        $dad_job = $request->father_job;
        $dad_phone = $request->father_phone;

        if(!empty($request->mother_name)){
            $mom_name = $request->mother_name;
        }else{
            $mom_name = '';
        }
        $mom_birthday = $request->mother_birthday;
        $mom_job = $request->mother_job;
        $mom_phone = $request->mother_phone;

        if(StudentRelation::where('student_id', $request->student_id)->count() == 2){
            $stu_relations = StudentRelation::where('student_id', $request->student_id)->get();
            foreach($stu_relations as $stu_relation){
                $relation = Relation::findOrFail($stu_relation->relation_id);
                if($relation->role == 1){
                    $relation->name = $dad_name;
                    $relation->birthday = $dad_birthday;
                    $relation->phone = $dad_phone;
                    $relation->job = $dad_job;
                    $relation->save();
                }else{
                    $relation->name = $mom_name;
                    $relation->birthday = $mom_birthday;
                    $relation->phone = $mom_phone;
                    $relation->job = $mom_job;
                    $relation->save();
                }
            }
        }elseif(StudentRelation::where('student_id', $request->student_id)->count() == 1){
            $stu_relation = StudentRelation::where('student_id', $request->student_id)->first();
            $relation = Relation::findOrFail($stu_relation->relation_id);
            if($relation->role == 1){
                $relation->name = $dad_name;
                $relation->birthday = $dad_birthday;
                $relation->phone = $dad_phone;
                $relation->job = $dad_job;
                $relation->save();
                self::insert_relation($request, $mom_name, $mom_birthday, $mom_phone, $mom_job, '0');
            }else{
                $relation->name = $mom_name;
                $relation->birthday = $mom_birthday;
                $relation->phone = $mom_phone;
                $relation->job = $mom_job;
                $relation->save();
                self::insert_relation($request, $dad_name, $dad_birthday, $dad_phone, $dad_job, '1');
            }
        }else{
            if(!empty($dad_name)){
                self::insert_relation($request, $dad_name, $dad_birthday, $dad_phone, $dad_job, '1');
            }
            if(!empty($mom_name)){
                self::insert_relation($request, $mom_name, $mom_birthday, $mom_phone, $mom_job, '0');
            }
        }

        return response()->json([
            'message' => 'Cập nhật thông tin thành công!'
        ]);
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function insert_relation(Request $request, $name, $birthday, $phone, $job, $role){
        Relation::insert([
            'name' => $name,
            'birthday' => $birthday,
            'phone' => $phone,
            'job' => $job,
            'role' => $role,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        StudentRelation::insert([
            'student_id' => $request->student_id,
            'relation_id' => Relation::max('id'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    //handle upload profile image
    public function ajaxupload(Request $request){
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($validation->passes()){
            $image = $request->file('select_file');
            $new_name = rand().'.'.$image->getClientOriginalExtension();
            File::delete('images/'.$request->current_img);
            $image->move(public_path('images'), $new_name);

            $student = Student::findOrFail($request->student_id);
            $student->image = $new_name;
            $student->save();

            return response()->json([
                'message' => 'Cập nhật ảnh đại diện thành công',
                'uploaded_image' => $new_name,
            ]);
        }else{
            return response()->json([
                'message' => $validation->errors()->all(),
                'uploaded_image' => $new_name,
            ]);
        }
    }

    //handle fetch classrooms
    function fetchclassrooms(Request $request){
        $faculty_id = $request->get('faculty_id');
        $data = DB::table('class_rooms')
                ->where("faculty_id", $faculty_id)
                ->get();
        $output = '<option value="0" disabled selected>=== Chọn Lớp ===</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->id.'">'.$row->id.'</option>';
        }
        echo $output;
    }

    //handle is submit union note
    function submit_union_note(Request $request){
        $student = Student::findOrFail($request->student_id);
        $student->is_submit = ($request->is_submit == "true") ? 1 : 0;
        $student->save();
        return;
    }

    //getPaginateStudents
    public function getPaginateStudents(Request $request)
    {
        if($request->ajax()){
            $classroom_id = $request->get('classroom_id');
            $query = $request->get('query');
            if($query != null){
                $students = User::select('users.id', 'users.name', 'users.phone', 'users.email',
                                'students.id', 'students.birthday')
                ->join('students', 'students.user_id', '=', 'users.id')
                ->where('class_room_id', $classroom_id)
                ->where(function($sub_query) use ($query){
                    $sub_query->where('students.id', 'like', '%'.$query.'%')
                    ->orWhere('users.name', 'like', '%'.$query.'%')
                    ->orWhere('users.phone', 'like', '%'.$query.'%')
                    ->orWhere('users.email', 'like', '%'.$query.'%');
                })
                ->paginate(20);
            }else{
                $students = User::select('users.id', 'users.name', 'users.phone', 'users.email',
                                'students.id', 'students.birthday')
                ->join('students', 'students.user_id', '=', 'users.id')
                ->where('class_room_id', $classroom_id)
                ->paginate(20);
            }
            $total_row = $students->total();
            return view('partials.pagination_students', compact(['students', 'classroom_id',
            'total_row']))
            ->render();
        }
    }

    //getPaginateStudentsManage
    public function getPaginateStudentsManage(Request $request)
    {
        if($request->ajax()){
            $query = $request->get('query');
            if($query != null){
                $students = Student::select('students.id', 'students.name', 'students.class_room_id',
                'students.created_at', 'faculties.name as faculty_name')
                ->join('class_rooms', 'class_rooms.id', '=', 'students.class_room_id')
                ->join('faculties', 'faculties.id', '=', 'class_rooms.faculty_id')
                ->orderBy('students.class_room_id', 'ASC')
                ->where('students.id', 'like', '%'.$query.'%')
                ->orWhere('students.name', 'like', '%'.$query.'%')
                ->orWhere('students.class_room_id', 'like', '%'.$query.'%')
                ->orWhere('faculties.name', 'like', '%'.$query.'%')
                ->paginate(40);
            }else{
                $students = Student::select('students.id', 'students.name', 'students.class_room_id',
                'students.created_at', 'faculties.name as faculty_name')
                ->join('class_rooms', 'class_rooms.id', '=', 'students.class_room_id')
                ->join('faculties', 'faculties.id', '=', 'class_rooms.faculty_id')
                ->orderBy('students.class_room_id', 'ASC')
                ->paginate(40);
            }
            $total_row = $students->total();
            return view('partials.pagination_students_manage', compact(['students', 'total_row']))
            ->render();
        }
    }
}
