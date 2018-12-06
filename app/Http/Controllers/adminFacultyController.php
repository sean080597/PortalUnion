<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Faculty;
use App\Student;
use App\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Resources\FacultyResource;

class adminFacultyController extends Controller
{
    public function __construct() {
        //$this->middleware(['auth', 'checkrole']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFaculties(){
        return Faculty::orderby('name','asc')->get();
    }
    public function index()
    {
        $faculties = Faculty::orderby('name','asc')->get();
        return view('admin.faculty',['faculties'=>$faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
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
        if(Faculty::where('id',$request->id)->count()>0){
            $msg['success'] = 'Khoa đã tồn tại';
        }else{
            $fac = new Faculty;
            $fac->id = $request->id;
            $fac->name = $request->name;
            $fac->note = $request->note;
            $fac->save();
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
        $faculty = Faculty::findOrFail($id);
        return $faculty;
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
        Faculty::where('id',$id)->update([
            'name' => $request->name,
            'note' => $request->note
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
        $count = ClassRoom::where('faculty_id',$id)->count();
        if($count > 0 ){
            return 'Không thể xóa vì còn lớp';
        }
        else{
            Faculty::where('id',$id)->delete();
            return 'Đã xóa thành công';
        }
    }
}
