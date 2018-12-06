<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use App\Faculty;
use App\Http\Resources\ClassRoomResource;
use App\Student;

class adminClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.classroom');
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
        $msg = array();
        if(ClassRoom::where('id',$request->id)->count()>0){
            $msg['success'] = 'Lớp này đã tồn tại';
        }else{
            $class = new ClassRoom;
            $class->faculty_id = $request->faculty_id;
            $class->id = $request->id;
            $class->save();
            $msg['success'] = 'Tạo khoa thành công';
        }
        return $msg;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = new ClassRoomResource(ClassRoom::where('id',$id)->first());
        return [
            'class' => $class,//data ten resource thanh class
        ];
    }
    public function showAll(){
        $classes = ClassRoomResource::collection(ClassRoom::orderby('id','asc')->get());
        return $classes;//Resource chuyen classes thanh data:
    }
    public function showToEdit($id){
        $class = ClassRoom::where('id',$id)->first();
        $classes = new ClassRoomResource($class);
        $fac = Faculty::where('id',$class->faculty_id)->first();
        $faculties = Faculty::all()->except($fac->id);
        return [
            'class'=>$classes,
            'faculties'=>$faculties
        ];//Resource chuyen classes thanh data:
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = array();
        ClassRoom::where('id',$id)->update([
            'faculty_id' => $request->faculty_id,
        ]);
        $msg['success']= 'Cập nhật thành công';
        return $msg;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Student::where('class_room_id',$id)->count();
        if($count > 0 ){
            return 'Không thể xóa vì còn sinh viên';
        }
        else{
            ClassRoom::where('id',$id)->delete();
            return 'Đã xóa thành công';
        }
    }
}
