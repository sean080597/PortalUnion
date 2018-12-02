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
        $this->middleware(['auth', 'checkrole'])->except(['update', 'ajaxupload']);
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

    public function manage()
    {
        $info_students = [];
        $all_faculties = Faculty::all();
        $all_classrooms = ClassRoom::all();
        $top_students = Student::take(10)->get();

        foreach ($top_students as $student){
            $arr = [
                'id' => $student->id,
                'name' => $student->name,
                'classroom_id' => $student->class_room_id,
                'faculty_name' => Faculty::where('id', ClassRoom::where('id', $student->class_room_id)->first()->faculty_id)->first()->name
            ];
            $info_students[] = $arr;
        }
        return view('students.manage', ['info_students' => $info_students]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($faculty_id, $classroom_id)
    {
        $all_students = Student::all();
        $all_users = User::all();
        $all_classrooms = ClassRoom::all();

        $students = Student::where('class_room_id', $classroom_id)->get();
        return view('students.index', ['students' => $students, 'all_students' => $all_students, 'all_users' => $all_users, 'all_classrooms' => $all_classrooms]);
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
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();
        $cur_student = $all_students->where('user_id', Auth::user()->id)->first();

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

        return view('students.show', ['student' => $student, 'all_classrooms' => $all_classrooms, 'all_students' => $all_students, 'user' => $user, 'faculty' => $faculty, 'dad' => $dad, 'mom' => $mom]);
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
        $student->sex = $request->sex;
        $student->phone = $request->phonenum;
        $student->hometown = $request->hometown;
        $student->union_date = $request->doan;
        $student->ethnic = $request->dantoc;
        $student->religion = $request->tongiao;
        $student->save();

        //get info to update table users
        $user = User::findOrFail($request->user_id);
        $user->email = $request->email;
        $user->save();

        // //get info to update table relations
        if(!empty($request->tencha)){
            $dad_name = $request->tencha;
        }else{
            $dad_name = 'NO NAMED';
        }
        $dad_birthday = $request->ngaysinhcha;
        $dad_job = $request->nghenghiepcha;
        $dad_phone = $request->dienthoaicha;

        if(!empty($request->tenme)){
            $mom_name = $request->tenme;
        }else{
            $mom_name = 'NO NAMED';
        }
        $mom_birthday = $request->ngaysinhme;
        $mom_job = $request->nghenghiepme;
        $mom_phone = $request->dienthoaime;

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

    //handle upload profil image
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
}
