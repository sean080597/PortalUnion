<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\Faculty;
use App\ClassRoom;
use App\Student;
use App\CriteriaMandatory;
use App\CriteriaSelfregis;
use App\StudentCriteriaMandatory;
use App\StudentCriteriaSelfregis;

class CriteriaManagermentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole'])->except('submit_evaluation');
    }

    public function student_evaluate($student_id)
    {
        $all_students = Student::all();
        $all_classrooms = ClassRoom::all();
        $cri_mandatory = CriteriaMandatory::all();
        $cri_selfregis = CriteriaSelfregis::all();

        $ls_stu_criman = StudentCriteriaMandatory::where('student_id', $student_id)->get();
        $ls_stu_crisel = StudentCriteriaSelfregis::where('student_id', $student_id)->get();

        $logged_student = Student::where('user_id', auth()->user()->id)->first();
        $showed_student = Student::where('id', $student_id)->first();
        //get classroom & faculty
        $class = ClassRoom::findOrFail($showed_student->class_room_id);
        $faculty = Faculty::findOrFail($class->faculty_id);
        return view('criteria-evaluation.student_evaluate',
        ['all_students' => $all_students, 'showed_student' => $showed_student,
        'logged_student' => $logged_student, 'faculty' => $faculty,
        'all_classrooms' => $all_classrooms, 'cri_mandatory' => $cri_mandatory,
        'cri_selfregis' => $cri_selfregis, 'ls_stu_criman' => $ls_stu_criman,
        'ls_stu_crisel' => $ls_stu_crisel]);
    }

    public function submit_evaluation(Request $request){
        $stu_criman = StudentCriteriaMandatory::where('student_id', $request->student_id)->first();

        //check if exists student
        if(empty($stu_criman)){
            $count = 0;
            foreach($request->arr_criman_id as $criman_id){
                $self_ass = empty($request->arr_criman_selfassess)?'':$request->arr_criman_selfassess[$count];
                $mark_stu = empty($request->arr_criman_markstu)?'0':$request->arr_criman_markstu[$count];
                $mark_cla = empty($request->arr_criman_markcla)?'0':$request->arr_criman_markcla[$count];
                $mark_fac = empty($request->arr_criman_markfac)?'0':$request->arr_criman_markfac[$count];
                $mark_sch = empty($request->arr_criman_marksch)?'0':$request->arr_criman_marksch[$count];
                $cri = StudentCriteriaMandatory::insert([
                    'student_id' => $request->student_id,
                    'criteria_id' => $criman_id,
                    'self_assessment' => $self_ass,
                    'mark_student' => $mark_stu,
                    'mark_classroom' => $mark_cla,
                    'mark_faculty' => $mark_fac,
                    'mark_school' => $mark_sch,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $count++;
            }
            $count = 0;
            foreach($request->arr_crisel_id as $crisel_id){
                $cont_reg = empty($request->arr_crisel_content)?'':$request->arr_crisel_content[$count];
                $self_ass = empty($request->arr_criman_selfassess)?'':$request->arr_criman_selfassess[$count];
                $mark_stu = empty($request->arr_crisel_markstu)?'0':$request->arr_crisel_markstu[$count];
                $mark_cla = empty($request->arr_crisel_markcla)?'0':$request->arr_crisel_markcla[$count];
                $mark_fac = empty($request->arr_crisel_markfac)?'0':$request->arr_crisel_markfac[$count];
                $mark_sch = empty($request->arr_crisel_marksch)?'0':$request->arr_crisel_marksch[$count];
                $cri = StudentCriteriaSelfregis::insert([
                    'student_id' => $request->student_id,
                    'criteria_id' => $crisel_id,
                    'content_regis' => $cont_reg,
                    'self_assessment' => $self_ass,
                    'mark_student' => $mark_stu,
                    'mark_classroom' => $mark_cla,
                    'mark_faculty' => $mark_fac,
                    'mark_school' => $mark_sch,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $count++;
            }
        }else{
            $count = 0;
            foreach($request->arr_criman_id as $criman_id){
                $self_ass = empty($request->arr_criman_selfassess)?'':$request->arr_criman_selfassess[$count];
                $mark_stu = empty($request->arr_criman_markstu)?'0':$request->arr_criman_markstu[$count];
                $mark_cla = empty($request->arr_criman_markcla)?'0':$request->arr_criman_markcla[$count];
                $mark_fac = empty($request->arr_criman_markfac)?'0':$request->arr_criman_markfac[$count];
                $mark_sch = empty($request->arr_criman_marksch)?'0':$request->arr_criman_marksch[$count];
                StudentCriteriaMandatory::where('student_id', $request->student_id)
                ->where('criteria_id', $criman_id)
                ->update([
                    'self_assessment' => $self_ass,
                    'mark_student' => $mark_stu,
                    'mark_classroom' => $mark_cla,
                    'mark_faculty' => $mark_fac,
                    'mark_school' => $mark_sch,
                ]);
                $count++;
            }

            $count = 0;
            foreach($request->arr_crisel_id as $crisel_id){
                $cont_reg = empty($request->arr_crisel_content)?'':$request->arr_crisel_content[$count];
                $self_ass = empty($request->arr_criman_selfassess)?'':$request->arr_criman_selfassess[$count];
                $mark_stu = empty($request->arr_crisel_markstu)?'0':$request->arr_crisel_markstu[$count];
                $mark_cla = empty($request->arr_crisel_markcla)?'0':$request->arr_crisel_markcla[$count];
                $mark_fac = empty($request->arr_crisel_markfac)?'0':$request->arr_crisel_markfac[$count];
                $mark_sch = empty($request->arr_crisel_marksch)?'0':$request->arr_crisel_marksch[$count];
                StudentCriteriaSelfregis::where('student_id', $request->student_id)
                ->where('criteria_id', $crisel_id)
                ->update([
                    'content_regis' => $cont_reg,
                    'self_assessment' => $self_ass,
                    'mark_student' => $mark_stu,
                    'mark_classroom' => $mark_cla,
                    'mark_faculty' => $mark_fac,
                    'mark_school' => $mark_sch,
                ]);
                $count++;
            }
        }
        return 'Cảm ơn đã đánh giá';
    }
}
