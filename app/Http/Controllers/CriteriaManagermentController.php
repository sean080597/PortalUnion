<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\User;
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

    public function classroom_evaluate($faculty_id, $classroom_id)
    {
        //students of classroom_id
        // $students = Student::where('class_room_id', $classroom_id)->get();
        // return view('criteria-evaluation.classroom_evaluate', ['students' => $students]);
    }

    public function student_evaluate($student_id)
    {
        $cri_mandatory = CriteriaMandatory::all();
        $cri_selfregis = CriteriaSelfregis::all();

        $ls_stu_criman = StudentCriteriaMandatory::where('student_id', $student_id)->get();
        $ls_stu_crisel = StudentCriteriaSelfregis::where('student_id', $student_id)->get();

        $showed_student = Student::findOrfail($student_id);
        $cur_student = Student::where('user_id', auth()->user()->id)->first();
        //to show faculty of showed student
        $showed_faculty = ClassRoom::findOrfail($showed_student->class_room_id)->load('faculty');
        //check if is student
        if(!empty($cur_student)){
            //get classroom for layouts.app
            $cur_classroom = ClassRoom::findOrfail($cur_student->class_room_id);
            return view('criteria-evaluation.student_evaluate',
            ['showed_student' => $showed_student, 'showed_faculty' => $showed_faculty,
            'cur_student' => $cur_student, 'cur_classroom' => $cur_classroom,
            'cri_mandatory' => $cri_mandatory, 'cri_selfregis' => $cri_selfregis,
            'ls_stu_criman' => $ls_stu_criman, 'ls_stu_crisel' => $ls_stu_crisel]);
        }else{
            return view('criteria-evaluation.student_evaluate',
            ['showed_student' => $showed_student, 'showed_faculty' => $showed_faculty,
            'cur_student' => $cur_student, 'cri_mandatory' => $cri_mandatory,
            'cri_selfregis' => $cri_selfregis, 'ls_stu_criman' => $ls_stu_criman,
            'ls_stu_crisel' => $ls_stu_crisel]);
        }
    }

    public function submit_evaluation(Request $request){
        $stu_criman = StudentCriteriaMandatory::where('student_id', $request->student_id)->first();
        //check if exists student
        if(empty($stu_criman)){
            $count = 0;
            foreach($request->arr_criman_id as $criman_id){
                $self_ass = $request->arr_criman_selfassess[$count];
                $mark_stu = $request->arr_criman_markstu[$count];
                $mark_cla = $request->arr_criman_markcla[$count];
                $mark_fac = $request->arr_criman_markfac[$count];
                $mark_sch = $request->arr_criman_marksch[$count];
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
                $cont_reg = $request->arr_crisel_content[$count];
                $self_ass = $request->arr_criman_selfassess[$count];
                $mark_stu = $request->arr_crisel_markstu[$count];
                $mark_cla = $request->arr_crisel_markcla[$count];
                $mark_fac = $request->arr_crisel_markfac[$count];
                $mark_sch = $request->arr_crisel_marksch[$count];
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
                $self_ass = $request->arr_criman_selfassess[$count];
                $mark_stu = $request->arr_criman_markstu[$count];
                $mark_cla = $request->arr_criman_markcla[$count];
                $mark_fac = $request->arr_criman_markfac[$count];
                $mark_sch = $request->arr_criman_marksch[$count];
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
                $cont_reg = $request->arr_crisel_content[$count];
                $self_ass = $request->arr_crisel_selfassess[$count];
                $mark_stu = $request->arr_crisel_markstu[$count];
                $mark_cla = $request->arr_crisel_markcla[$count];
                $mark_fac = $request->arr_crisel_markfac[$count];
                $mark_sch = $request->arr_crisel_marksch[$count];
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
