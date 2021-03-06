<?php

namespace App\Http\Middleware;

use Closure;
use App\ClassRoom;
use App\Student;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_roleid = auth()->user()->role_id;
        //get faculty_id of user
        $cur_student = Student::where('user_id', auth()->user()->id)->first();
        $cur_classroom = null;
        if($cur_student != null){
            $cur_classroom = ClassRoom::where('id', $cur_student->class_room_id)->first();
        }

        //check if the user is admin
        if($user_roleid == 'adm'){
            return $next($request);
        }

        if ($request->is(['faculties/manage', 'classrooms/manage', 'admin/',
        'students/manage', 'students/manage/show/*'])){
            if($user_roleid == 'sch'){
                return $next($request);
            }
            if($user_roleid != 'adm'){
                return redirect('401');
            }
        }

        //check if redirecting to the faculty page
        if ($request->is(['faculties', 'faculties/*']))
        {
            if ($user_roleid == 'sch')
            {
                return $next($request);
            }
        }

        //check if redirecting to the classroom page
        if ($request->is('classrooms/*'))
        {
            if($user_roleid == 'fac'){
                $user_faculty_id = $cur_classroom->faculty_id;
                if($request->route('faculty_id') == $user_faculty_id){
                    return $next($request);
                }
            }

            if ($user_roleid == 'sch')
            {
                return $next($request);
            }
        }

        //check if redirecting to the student page
        if ($request->is(['students/*/*', 'criteria-evaluation/*/*']))
        {
            if($user_roleid == 'stu' && $request->is('students/show/*')){
                //get logged student
                if($request->route('student_id') == $cur_student->id){
                    return $next($request);
                }
            }

            if($user_roleid == 'cla'){
                //get logged student
                $user_faculty_id = $cur_classroom->faculty_id;
                //check if the request is students/show/*
                if(!empty($request->route('student_id'))){
                    $showed_student = Student::findOrfail($request->route('student_id'));
                    if(strtolower($showed_student->class_room_id) == strtolower($cur_student->class_room_id)){
                        return $next($request);
                    }
                }
                //check if the request is students/faculty_id/classroom_id
                else{
                    $logged_faculty_id = $cur_classroom->faculty_id;
                    if(strtolower($request->route('faculty_id')) == strtolower($logged_faculty_id)){
                        if(strtolower($request->route('classroom_id')) == strtolower($cur_student->class_room_id)){
                            return $next($request);
                        }
                    }
                }
            }

            if($user_roleid == 'fac'){
                //get logged student
                $user_faculty_id = $cur_classroom->faculty_id;
                //check if the request is students/show/*
                if(!empty($request->route('student_id'))){
                    //get showing student
                    $showed_student = Student::findOrfail($request->route('student_id'));
                    //return if not found
                    if(empty($showed_student)){
                        return redirect('notfound');
                    }
                    //return if not allowed
                    else{
                        $showed_classroom_id = ClassRoom::findOrfail($showed_student->class_room_id);
                        $showed_faculty_id = $showed_classroom_id->faculty_id;
                        if(strtolower($showed_faculty_id) == strtolower($user_faculty_id)){
                            return $next($request);
                        }
                    }
                }
                //check if the request is students/faculty_id/classroom_id
                else{
                    if($request->route('faculty_id') == $user_faculty_id){
                        if(empty($cur_classroom)){
                            return redirect('notfound');
                        }else{
                            return $next($request);
                        }
                    }
                }
            }

            if ($user_roleid == 'sch')
            {
                return $next($request);
            }
        }

        return redirect('401');
    }
}
