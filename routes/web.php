<?php

use App\Http\Controllers\adminFacultyController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('401', 'HomeController@deniedaccess')->name('deniedaccess');
Route::get('404', 'HomeController@notfound')->name('notfound');
//handle get info of a specific faculty
Route::get('/getInfoFaculty', 'FacultyController@getInfoFaculty');
//handle get search faculties
Route::get('/getSearchFaculties', 'FacultyController@getSearchFaculties');

Route::get('/faculties/destroy', ['as' => 'faculties.destroy', 'uses' => 'FacultyController@destroy']);
Route::get('/faculties/update', ['as' => 'faculties.update', 'uses' => 'FacultyController@update']);
Route::get('/faculties/create', ['as' => 'faculties.create', 'uses' => 'FacultyController@create']);
Route::get('/faculties/manage', ['as' => 'faculties.manage', 'uses' => 'FacultyController@manage']);
Route::get('/faculties', ['as' => 'faculties.index', 'uses' => 'FacultyController@index']);

//handle get students pagination
Route::get('/getPaginateFaculties', 'FacultyController@getPaginateFaculties');

//handle manage classroom ----------------------------------------------------------------------
Route::get('/classrooms/destroy', 'ClassRoomController@destroy');
Route::get('/classrooms/update', 'ClassRoomController@update');
Route::get('/classrooms/create', 'ClassRoomController@create');

//handle get sel options faculty
Route::get('/getSelFaculties', 'ClassRoomController@getSelFaculties');

Route::get('/classrooms/getlistclassrooms', 'ClassRoomController@getlistclassrooms');
Route::get('/classrooms/manage', ['as' => 'classrooms.manage', 'uses' => 'ClassRoomController@manage']);
Route::get('/classrooms/{faculty_id}', ['as' => 'classrooms.index', 'uses' => 'ClassRoomController@index']);

//handle get classrooms pagination
Route::get('/getPaginateClassrooms', 'ClassRoomController@getPaginateClassrooms');
Route::get('/getPaginateClassroomsManage', 'ClassRoomController@getPaginateClassroomsManage');

//handle is submit union note ----------------------------------------------------------------------
Route::post('/students/submit_union_note', 'StudentController@submit_union_note')->name('submit_union_note');
//handle fetch data when change select faculty
Route::post('/students/fetchDependentClassrooms', 'StudentController@fetchDependentClassrooms')->name('fetchDependentClassrooms');
//handle get more student when scroll to the bottom of page
Route::get('/students/getMoreStudents', 'StudentController@getMoreStudents')->name('getMoreStudents');
//handle upload profile image
Route::post('/students/ajaxupload', 'StudentController@ajaxupload')->name('ajaxupload');


Route::post('/students/manage/delete', ['as' => 'students.managedelete', 'uses' => 'StudentController@destroy']);

Route::get('/students/manage/show/{student_id}', ['as' => 'students.manageshow', 'uses' => 'StudentController@manageshow']);
Route::get('/students/manage', ['as' => 'students.manage', 'uses' => 'StudentController@manage']);
Route::get('/students/manage/create', ['as' => 'students.managecreate', 'uses' => 'StudentController@create']);
Route::post('/students/manage/store', ['as' => 'students.managestore', 'uses' => 'StudentController@store']);
Route::get('/students/show/{student_id}', ['as' => 'students.show', 'uses' => 'StudentController@show']);
Route::get('/students/{faculty_id}/{classroom_id}', ['as' => 'students.index', 'uses' => 'StudentController@index']);
Route::post('/students/update', ['as' => 'students.update', 'uses' => 'StudentController@update']);

//handle get students pagination
Route::get('/getPaginateStudents', 'StudentController@getPaginateStudents');
Route::get('/getPaginateStudentsManage', 'StudentController@getPaginateStudentsManage');

//route for evaluate criteria ----------------------------------------------------------------------
Route::post('/criteria-evaluation/submit-evaluation', ['as' => 'criteria-evaluation.submit-evaluation', 'uses' => 'CriteriaManagermentController@submit_evaluation']);
Route::get('/criteria-evaluation/student-evaluate/{student_id}', ['as' => 'criteria-evaluation.student-evaluate', 'uses' => 'CriteriaManagermentController@student_evaluate']);
Route::get('/criteria-evaluation/{faculty_id}/{classroom_id}', ['as' => 'criteria-evaluation.classroom_evaluate', 'uses' => 'CriteriaManagermentController@classroom_evaluate']);

Route::resource('events', 'EventController');

Route::resource('relations', 'RelationController');

Route::resource('users', 'UserController');

Route::prefix('admin')->group(function(){
    Route::get('/', 'adminController@index');

    //Route::resource('student', 'adminStudentController');
    Route::get('student/','adminStudentController@index');
    Route::get('showAll','adminStudentController@showAll');
    Route::get('student/create','adminStudentController@createStudent');
    Route::get('student/{id}','adminStudentController@setStudent');
    Route::get('student/{id}/{idF}','adminFacultyController@showAllExcept');
    Route::get('student/{id}/getClass/{idF}','adminClassController@getClassesFollowFac');
    Route::post('student/{id}/update','adminStudentController@update');
    Route::post('student/create/store','adminStudentController@store');
    Route::post('student/create/get','adminFacultyController@showAllFac');
    Route::delete('student/{id}','adminStudentController@destroy');

    Route::resource('class', 'adminClassController');
    Route::get('getAllClass','adminClassController@showAll');
    Route::get('getToEdit/{id}','adminClassController@showToEdit');

    Route::resource('faculty', 'adminFacultyController');
    Route::get('getFaculties','adminFacultyController@getFaculties');

    Route::get('user/','adminUserController@index')->name('admin.user_index');
    Route::get('user/showAll','adminUserController@showAll');
    Route::get('user/{id}','adminUserController@show');
    Route::post('user/create','adminUserController@store');
    Route::put('user/{id}','adminUserController@update');
    Route::delete('user/{id}','adminUserController@destroy');
    Route::get('role/showAll','RoleController@showAll');
});
