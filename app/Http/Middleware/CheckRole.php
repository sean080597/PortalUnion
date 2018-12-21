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
        $all_classrooms = ClassRoom::all();
        $all_students = Student::all();

        //check if the user is admin
        if($user_roleid == 'adm'){
            return $next($request);
        }

        if ($request->is(['faculties/manage', 'classrooms/manage', 'admin/',
        'students/manage', 'students/manage/show/*'])){
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
                $cur_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $cur_student->class_room_id)->first()->faculty_id;
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
        if ($request->is('students/*/*'))
        {
            if($user_roleid == 'stu' && $request->is('students/show/*')){
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                if($request->route('student_id') == $logged_student->id){
                    return $next($request);
                }
            }

            if($user_roleid == 'cla'){
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                //check if the request is students/show/*
                if(!empty($request->route('student_id'))){
                    $showed_student = $all_students->where('id', $request->route('student_id'))->first();
                    if(strtolower($showed_student->class_room_id) == strtolower($logged_student->class_room_id)){
                        return $next($request);
                    }
                }
                //check if the request is students/faculty_id/classroom_id
                else{
                    $logged_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                    if(strtolower($request->route('faculty_id')) == strtolower($logged_faculty_id)){
                        if(strtolower($request->route('classroom_id')) == strtolower($logged_student->class_room_id)){
                            return $next($request);
                        }
                    }
                }
            }

            if($user_roleid == 'fac'){
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                //check if the request is students/show/*
                if(!empty($request->route('student_id'))){
                    $showed_student = $all_students->where('id', $request->route('student_id'))->first();
                    if(empty($showed_student)){
                        return redirect('notfound');
                    }else{
                        $showed_faculty_id = $all_classrooms->where('id', $showed_student->class_room_id)->first()->faculty_id;
                        if(strtolower($showed_faculty_id) == strtolower($user_faculty_id)){
                            return $next($request);
                        }
                    }
                }
                //check if the request is students/faculty_id/classroom_id
                else{
                    if($request->route('faculty_id') == $user_faculty_id){
                        $classroom = $all_classrooms->where('id', $request->route('classroom_id'))->first();
                        if(empty($classroom)){
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

        if ($request->is('criteria-evaluation/*/*')){
            if($user_roleid == 'stu' && $request->is('criteria-evaluation/student-evaluate/*')){
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                if($request->route('student_id') == $logged_student->id){
                    return $next($request);
                }
            }

            if ($user_roleid == 'cla')
            {
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                //check if the request is criteria-evaluation/show/*
                if(!empty($request->route('student_id'))){
                    //get showed student
                    $showed_student = $all_students->where('id', $request->route('student_id'))->first();
                    if(strtolower($showed_student->class_room_id) == strtolower($logged_student->class_room_id)){
                        return $next($request);
                    }
                }//check if the request is criteria-evaluation/faculty_id/classroom_id
                else{
                    $logged_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                    if(strtolower($request->route('faculty_id')) == strtolower($logged_faculty_id)){
                        if(strtolower($request->route('classroom_id')) == strtolower($logged_student->class_room_id)){
                            return $next($request);
                        }
                    }
                }
            }

            if ($user_roleid == 'fac')
            {
                //get logged student
                $logged_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $logged_student->class_room_id)->first()->faculty_id;
                //check if the request is criteria-evaluation/show/*
                if(!empty($request->route('student_id'))){
                    //get showed student
                    $showed_student = $all_students->where('id', $request->route('student_id'))->first();
                    if(empty($showed_student)){
                        return redirect('notfound');
                    }else{
                        $showed_faculty_id = $all_classrooms->where('id', $showed_student->class_room_id)->first()->faculty_id;
                        if(strtolower($showed_faculty_id) == strtolower($user_faculty_id)){
                            return $next($request);
                        }
                    }
                }//check if the request is criteria-evaluation/faculty_id/classroom_id
                else{
                    if($request->route('faculty_id') == $user_faculty_id){
                        $classroom = $all_classrooms->where('id', $request->route('classroom_id'))->first();
                        if(empty($classroom)){
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
