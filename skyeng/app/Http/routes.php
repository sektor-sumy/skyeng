<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('/teachers', 'TeacherController@index');
Route::get('/teachers/create', array('as' => 'teacher.create', 'uses' => 'TeacherController@create'));
Route::get('/teachers/total_students', array('as' => 'teacher.total_students', 'uses' => 'TeacherController@total_students'));
Route::post('/teachers', array('as' => 'teacher.store', 'uses' => 'TeacherController@store'));
Route::get('/teachers/{id}/show', array('as' => 'teacher.show', 'uses' => 'TeacherController@show'));
Route::match(array('DELETE'), '/teachers/{id}', array('as' => 'teacher.destroy', 'uses' => 'TeacherController@destroy'));
Route::match(array('PUT', 'PATCH'), 'teachers/{id}', array('as' => 'teacher.update', 'uses' => 'TeacherController@update'));
//Route::get('/{id}/show', 'WelcomeController@show');

Route::get('/students', 'StudentController@index');
Route::get('/students/some_students', array('as' => 'student.sume_students', 'uses' => 'StudentController@some_student'));
Route::get('/students/create', array('as' => 'student.create', 'uses' => 'StudentController@create'));
Route::post('/students', array('as' => 'student.store', 'uses' => 'StudentController@store'));
//Route::get('/students/{id}/show', array('as' => 'student.show', 'uses' => 'StudentController@show'));
Route::match(array('DELETE'), '/students/{id}', array('as' => 'student.destroy', 'uses' => 'StudentController@destroy'));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
