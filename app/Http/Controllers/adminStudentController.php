<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Resources\StudentResource;
    use App\Student;
    use App\StudentRelation;
    use App\Relation;
    use App\User;

    class adminStudentController extends Controller
    {
        public function __construct() {
            $this->middleware(['auth', 'checkrole']);
        }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('admin.student');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function createStudent()
        {
            return view('admin.createStudent');
            //return ['d'=>$handle];
        }
        public function setStudent($id){
            $student = Student::where('id',$id)->first();
            $relations = StudentRelation::where('student_id',$id)->get();
            $dad = $mom = '';
            foreach($relations as $item){
                $relation = Relation::findOrFail($item->relation_id);
                if($relation->role == 1){
                    $dad = $relation;
                }else{
                    $mom = $relation;
                }
            }
            return view('admin.updateStudent',['student'=>$student,'dad'=>$dad, 'mom'=>$mom]);
            //return ['student'=>$student,'dad'=>$father, 'mom'=>$mother];
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $userOld = User::where('email',$request->email)->get();
            if($userOld->isNotEmpty()){
                return "Email đã tồn tại";
            }
            else{
                $studentOld = Student::where('id',$request->mssv)->get();
                if($studentOld->isNotEmpty()){
                    return "Đoàn viên đã tồn tại";
                }else{
                    $user = new User;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->mssv);
                    $user->role_id = "stu";
                    $user->save();
                    $student = new Student;
                    $student->id = $request->mssv;
                    $student->name = $request->name;
                    //img:$img,
                    $student->birthday = $request->birthday;
                    $student->sex = $request->sex;
                    $student->union_date= $request->union_date;
                    $student->hometown= $request->hometown;
                    $student->ethnic= $request->ethnic;
                    $student->religion= $request->religion;
                    //$student->is_submit= $request->is_submit;
                    $student->phone= $request->phonenum;
                    //$student->email=>$request->email;
                    $student->address= $request->address;
                    $student->class_room_id= $request->class_room;
                    $student->user_id = $user->id;
                    $student->save();
                    if(!empty($request->father_name)){
                        $this->createRelation($student->id,$request->father_name,$request->father_birthday,$request->father_job,$request->father_phone,1);
                    }
                    if(!empty($request->mother_name)){
                        $this->createRelation($student->id,$request->mother_name,$request->mother_birthday,$request->mother_job,$request->mother_phone,0);
                    }
                    return 'Tạo mới thành công';
                }
            }
        }
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            return Student::where('id',$id)->findOrFail();
        }
        public function showAll()
        {
            $students = StudentResource::collection(Student::orderby('id','asc')->get());
            return $students;//Resource chuyen classes thanh data:
        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            return view('admin.upStudent');
        }
        public function createRelation($student_id,$name,$birthday,$job,$phone,$role){
            $r = new Relation;
            $r->name = $name;
            $r->birthday= $birthday;
            $r->job= $job;
            $r->phone= $phone;
            $r->role = $role;
            $r->save();
            $sR = new StudentRelation;
            $sR->student_id = $student_id;
            $sR->relation_id = $r->id;
            $sR->save();
        }
        public function updateRelation($relation_id,$name,$birthday,$job,$phone,$role){
            Relation::where('id',$relation_id)->where('role',$role)->update([
                'name'=>$name,
                'birthday'=>$birthday,
                'phone'=>$phone,
                'job'=>$job
            ]);
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
            Student::where('id',$id)->update([
                'name'=>$request->name,
                //img:$img,
                'birthday'=>$request->birthday,
                'sex'=>$request->sex,
                'union_date'=>$request->union_date,
                'hometown'=>$request->hometown,
                'ethnic'=>$request->ethnic,
                'religion'=>$request->religion,
                //'is_submit'=>$request->is_submit,
                'phone'=>$request->phonenum,
                //'email'=>$request->email,
                'address'=>$request->address,
                'class_room_id'=>$request->class_room,
            ]);
            if(!empty($request->father_name)){
                $studentRelation = StudentRelation::where('student_id',$request->mssv)->get();
                $count = 0;
                foreach ($studentRelation as $key => $value) {
                    $f = Relation::where('id',$value->relation_id)->where('role',1)->get();
                    if($f->isNotEmpty()){
                        $this->updateRelation($value->relation_id,$request->father_name,$request->father_birthday,$request->father_job,$request->father_phone,1);
                        $count++;
                    }
                }
                if($count==0){
                    $this->createRelation($id,$request->father_name,$request->father_birthday,$request->father_job,$request->father_phone,1);
                }
            }
            if(!empty($request->mother_name)){
                $studentRelation = StudentRelation::where('student_id',$request->mssv)->get();
                $count = 0;
                foreach ($studentRelation as $key => $value) {
                    $f = Relation::where('id',$value->relation_id)->where('role',0)->get();
                    if($f->isNotEmpty()){
                        $this->updateRelation($value->relation_id,$request->mother_name,$request->mother_birthday,$request->mother_job,$request->mother_phone,0);
                        $count++;
                    }
                }
                if($count==0){
                    $this->createRelation($id,$request->mother_name,$request->mother_birthday,$request->mother_job,$request->mother_phone,0);
                }
            }
            return 'Cập nhật thành công';
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $td = Student::where('id',$id)->first();
            $user_id = $td->user_id;
            $td->delete();
            User::where('id',$user_id)->delete();
            return 'Đã xóa thành công';
        }
    }
