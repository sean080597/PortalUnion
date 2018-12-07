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
        $this->middleware(['auth']);
    }

    public function student_evaluate()
    {
        $all_students = Student::all();
        $cur_student = Student::where('user_id', Auth::user()->id)->first();
        //get classroom & faculty
        $class = ClassRoom::findOrFail($cur_student->class_room_id);
        $faculty = Faculty::findOrFail($class->faculty_id);

        $cri_mandatory = CriteriaMandatory::all();
        $cri_selfregis = CriteriaSelfregis::all();

        return view('criteria-evaluation.student_evaluate',
        ['all_students' => $all_students, 'student' => $cur_student, 'faculty' => $faculty,
        'cri_mandatory' => $cri_mandatory, 'cri_selfregis' => $cri_selfregis]);
    }
}
