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

Route::get('/faculties/getlistfaculties', 'FacultyController@getlistfaculties');
Route::get('/faculties/destroy', ['as' => 'faculties.destroy', 'uses' => 'FacultyController@destroy']);
Route::get('/faculties/manage', ['as' => 'faculties.manage', 'uses' => 'FacultyController@manage']);
Route::resource('faculties', 'FacultyController', ['except' => ['destroy']]);

//handle manage classroom
Route::get('/classrooms/destroy', 'ClassRoomController@destroy');
Route::get('/classrooms/update', 'ClassRoomController@update');

Route::get('/classrooms/add_new_classroom', 'ClassRoomController@addnewclassroom');
Route::get('/classrooms/get_sel_faculties', 'ClassRoomController@getselfaculties');
Route::get('/classrooms/getlistclassrooms', 'ClassRoomController@getlistclassrooms');
Route::get('/classrooms/manage', ['as' => 'classrooms.manage', 'uses' => 'ClassRoomController@manage']);

Route::get('/classrooms', ['as' => 'classrooms.index', 'uses' => 'ClassRoomController@index']);
Route::post('/classrooms', ['as' => 'classrooms.index', 'uses' => 'ClassRoomController@index']);

Route::post('/students', ['as' => 'students.index', 'uses' => 'StudentController@index']);
Route::post('/students/show', ['as' => 'students.show', 'uses' => 'StudentController@show']);
Route::post('/students/{student}', ['as' => 'students.update', 'uses' => 'StudentController@update']);

Route::resource('events', 'EventController');

Route::resource('criterias', 'CriteriaController');

Route::resource('criteiontypes', 'CriterionTypeController');

Route::resource('relations', 'RelationController');

Route::resource('faculties', 'FacultyController');

Route::resource('users', 'UserController');