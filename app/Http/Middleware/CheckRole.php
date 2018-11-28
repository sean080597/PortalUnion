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

        if ($request->is('faculties/manage')){
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
            if ($user_roleid == 'sch')
            {
                return $next($request);
            }
            if($user_roleid == 'fac'){
                $cur_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $cur_student->class_room_id)->first()->faculty_id;
                if($request->route('faculty_id') == $user_faculty_id){
                    return $next($request);
                }
            }
        }

        if ($request->is('students/show/*')){
            if($user_roleid != 'stu'){
                return $next($request);
            }else{
                $cur_student = $all_students->where('user_id', auth()->user()->id)->first();
                if($request->route('student_id') == $cur_student->id){
                    return $next($request);
                }
            }
        }

        //check if redirecting to the student page
        if ($request->is('students/*/*'))
        {
            if ($user_roleid == 'sch')
            {
                return $next($request);
            }
            //check faculty
            if($user_roleid == 'fac'){
                $cur_student = $all_students->where('user_id', auth()->user()->id)->first();
                $user_faculty_id = $all_classrooms->where('id', $cur_student->class_room_id)->first()->faculty_id;
                if($request->route('faculty_id') == $user_faculty_id){
                    return $next($request);
                }
            }

            if($user_roleid == 'cla'){
                $students = Student::where('class_room_id', $request->route('classroom_id'))->get();
                $cur_student = $all_students->where('user_id', auth()->user()->id)->first();
                //check faculty
                $user_faculty_id = $all_classrooms->where('id', $cur_student->class_room_id)->first()->faculty_id;
                if($request->route('faculty_id') == $user_faculty_id){
                    //check classroom
                    $user_classroom_id = $cur_student->class_room_id;
                    if(strtolower($request->route('classroom_id')) == $user_classroom_id){
                        return $next($request);
                    }
                }
            }
        }

        return redirect('401');
    }
}