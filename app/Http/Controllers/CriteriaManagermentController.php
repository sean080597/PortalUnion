<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Faculty;
use App\ClassRoom;
use App\Student;
use App\CriteriaMandatory;
use App\CriteriaSelfregis;

class CriteriaManagermentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'checkrole']);
    }

    public function student_evaluate($student_id)
    {
        $all_students = Student::all();
        $all_classrooms = ClassRoom::all();
        $cri_mandatory = CriteriaMandatory::all();
        $cri_selfregis = CriteriaSelfregis::all();

        $cur_student = Student::where('id', $student_id)->first();
        //check if the user is not acc school & admin
        // if(!empty($cur_student)){
            //get classroom & faculty
            $class = ClassRoom::findOrFail($cur_student->class_room_id);
            $faculty = Faculty::findOrFail($class->faculty_id);
            return view('criteria-evaluation.student_evaluate',
            ['all_students' => $all_students, 'student' => $cur_student, 'faculty' => $faculty,
            'all_classrooms' => $all_classrooms, 'cri_mandatory' => $cri_mandatory,
            'cri_selfregis' => $cri_selfregis]);
        // }
    }

    public function submit_evaluation(Request $request){
        return $request->all();
    }
}
