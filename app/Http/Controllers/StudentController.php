<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\ClassRoom;
use App\Faculty;
use App\Relation;
use App\StudentRelation;
use App\User;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::where('class_room_id', $request->input('classroom_id'))->get();
        $all_students = Student::all();
        $all_users = User::all();
        $all_classrooms = ClassRoom::all();
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
    public function show(Request $request)
    {
        $student = Student::findOrFail($request->input('student_id'));
        $user = User::where('id', $student->user_id)->first();
        //get faculty
        $class = ClassRoom::findOrFail($student->class_room_id);
        $faculty = Faculty::findOrFail($class->faculty_id);

        //get relations
        $list_relation = StudentRelation::where('student_id', $request->input('student_id'))->get();
        $dad = $mom = '';
        foreach($list_relation as $item){
            $relation = Relation::findOrFail($item->relation_id);
            if($relation->role == 1){
                $dad = $relation;
            }else{
                $mom = $relation;
            }
        }

        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();

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
        $dad_name = $request->tencha;
        $dad_birthday = $request->ngaysinhcha;
        $dad_job = $request->nghenghiepcha;
        $dad_phone = $request->dienthoaicha;

        $mom_name = $request->tenme;
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
            if(!empty($mom_name)){
                self::insert_relation($request, $mom_name, $mom_birthday, $mom_phone, $mom_job, '0');
            }
            if(!empty($dad_name)){
                self::insert_relation($request, $dad_name, $dad_birthday, $dad_phone, $dad_job, '1');
            }
        }
        return "<script>history.back(); alert('Student cập nhật thành công!'); </script>";
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
}
