<?php

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

Route::get('/faculties/getInfoFaculty', 'FacultyController@getInfoFaculty');
Route::get('/faculties/getlistfaculties', 'FacultyController@getlistfaculties');
Route::get('/faculties/destroy', ['as' => 'faculties.destroy', 'uses' => 'FacultyController@destroy']);
Route::get('/faculties/update', ['as' => 'faculties.update', 'uses' => 'FacultyController@update']);
Route::get('/faculties/create', ['as' => 'faculties.create', 'uses' => 'FacultyController@create']);
Route::get('/faculties/manage', ['as' => 'faculties.manage', 'uses' => 'FacultyController@manage']);
Route::resource('faculties', 'FacultyController', ['except' => ['create', 'update', 'destroy']]);

//handle manage classroom
Route::get('/classrooms/destroy', 'ClassRoomController@destroy');
Route::get('/classrooms/update', 'ClassRoomController@update');

Route::get('/classrooms/add_new_classroom', 'ClassRoomController@addnewclassroom');
Route::get('/classrooms/get_sel_faculties', 'ClassRoomController@getselfaculties');
Route::get('/classrooms/getlistclassrooms', 'ClassRoomController@getlistclassrooms');
Route::get('/classrooms/manage', ['as' => 'classrooms.manage', 'uses' => 'ClassRoomController@manage']);
Route::get('/classrooms/{faculty_id}', ['as' => 'classrooms.index', 'uses' => 'ClassRoomController@index']);

//handle is submit union note
Route::post('/students/submit_union_note', 'StudentController@submit_union_note')->name('submit_union_note');
//handle fetch data when change select faculty
Route::post('/students/fetchclassrooms', 'StudentController@fetchclassrooms')->name('fetchclassrooms');
//handle get more student when scroll to the bottom of page
Route::get('/students/getMoreStudents', 'StudentController@getMoreStudents')->name('getMoreStudents');
//handle upload profile image
Route::post('/students/ajaxupload', 'StudentController@ajaxupload')->name('ajaxupload');

Route::get('/students/manage/show/{student_id}', ['as' => 'students.manageshow', 'uses' => 'StudentController@manageshow']);
Route::get('/students/manage', ['as' => 'students.manage', 'uses' => 'StudentController@manage']);
Route::get('/students/show/{student_id}', ['as' => 'students.show', 'uses' => 'StudentController@show']);
Route::get('/students/{faculty_id}/{classroom_id}', ['as' => 'students.index', 'uses' => 'StudentController@index']);
Route::post('/students/update', ['as' => 'students.update', 'uses' => 'StudentController@update']);

Route::resource('events', 'EventController');

Route::resource('criterias', 'CriteriaController');

Route::resource('criteiontypes', 'CriterionTypeController');

Route::resource('relations', 'RelationController');

Route::resource('users', 'UserController');