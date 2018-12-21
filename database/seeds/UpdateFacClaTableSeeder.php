<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Faculty;
use App\ClassRoom;

class UpdateFacClaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_faculties = Faculty::all();
        foreach ($all_faculties as $key => $value) {
            $arr_classrooms = ClassRoom::where('faculty_id', $value->id)->pluck('id');
            $arr_users_of_fac = DB::table('students')->whereIn('class_room_id', $arr_classrooms)->get();
            if(count($arr_classrooms) != 0 && count($arr_users_of_fac) != 0){
                $fac = Faculty::where('id', $value->id)->first();
                $fac->update([
                    'uid_secretary' => $arr_users_of_fac[rand(0, count($arr_users_of_fac) - 1)]->user_id,
                    'uid_deputysecre1' => $arr_users_of_fac[rand(0, count($arr_users_of_fac) - 1)]->user_id,
                    'uid_deputysecre2' => $arr_users_of_fac[rand(0, count($arr_users_of_fac) - 1)]->user_id,
                ]);
            }
        }

        $all_classrooms = ClassRoom::all();
        foreach ($all_classrooms as $key => $value) {
            $arr_students = Student::where('class_room_id', $value->id)->pluck('user_id');
            if(count($arr_students) != 0){
                $cla = ClassRoom::where('id', $value->id)->first();
                $cla->update([
                    'uid_secretary' => $arr_students[rand(0, count($arr_students) - 1)],
                    'uid_deputysecre1' => $arr_students[rand(0, count($arr_students) - 1)],
                    'uid_deputysecre2' => $arr_students[rand(0, count($arr_students) - 1)]
                ]);
            }
        }
    }
}
