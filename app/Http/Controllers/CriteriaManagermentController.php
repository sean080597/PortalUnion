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

        $cur_student = Student::where('id', $student_id)->first();
        //get classroom & faculty
        $class = ClassRoom::findOrFail($cur_student->class_room_id);
        $faculty = Faculty::findOrFail($class->faculty_id);
        return view('criteria-evaluation.student_evaluate',
        ['all_students' => $all_students, 'student' => $cur_student, 'faculty' => $faculty,
        'all_classrooms' => $all_classrooms, 'cri_mandatory' => $cri_mandatory,
        'cri_selfregis' => $cri_selfregis, 'ls_stu_criman' => $ls_stu_criman,
        'ls_stu_crisel' => $ls_stu_crisel]);
    }

    public function submit_evaluation(Request $request){
        $stu_criman = StudentCriteriaMandatory::where('student_id', $request->student_id)->first();
        $whose_mark = '';
        switch (auth()->user()->role_id) {
            case 'stu':
                $whose_mark = 'mark_student';
                break;
            case 'cla':
                $whose_mark = 'mark_classroom';
                break;
            case 'fac':
                $whose_mark = 'mark_faculty';
                break;
            case 'sch':
                $whose_mark = 'mark_school';
                break;
            default:
                # code...
                break;
        }

        //check if exists student
        if(empty($stu_criman)){
            $count = 0;
            foreach($request->arr_criman_id as $criman_id){
                $cri = StudentCriteriaMandatory::create([
                    'student_id' => $request->student_id,
                    'criteria_id' => $criman_id,
                    'self_assessment' => $request->arr_criman_selfassess[$count],
                    $whose_mark => $request->arr_criman_mark[$count],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $count++;
            }
            $count = 0;
            foreach($request->arr_crisel_id as $crisel_id){
                $cri = StudentCriteriaSelfregis::insert([
                    'student_id' => $request->student_id,
                    'criteria_id' => $crisel_id,
                    'content_regis' => $request->arr_crisel_content[$count],
                    'self_assessment' => $request->arr_criman_selfassess[$count],
                    $whose_mark => $request->arr_criman_mark[$count],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $count++;
            }
        }else{
            $count = 0;
            foreach($request->arr_criman_id as $criman_id){
                StudentCriteriaMandatory::where('student_id', $request->student_id)
                ->where('criteria_id', $request->arr_criman_id[$count])
                ->update([
                    'self_assessment'=> $request->arr_criman_selfassess[$count],
                    $whose_mark => $request->arr_criman_mark[$count],
                ]);
                $count++;
            }

            $count = 0;
            foreach($request->arr_crisel_id as $crisel_id){
                StudentCriteriaSelfregis::where('student_id', $request->student_id)
                ->where('criteria_id', $crisel_id)
                ->update([
                    'content_regis' => $request->arr_crisel_content[$count],
                    'self_assessment'=> $request->arr_criman_selfassess[$count],
                    $whose_mark => $request->arr_criman_mark[$count],
                ]);
                $count++;
            }
        }
        return 'Cảm ơn đã đánh giá';
    }
}
