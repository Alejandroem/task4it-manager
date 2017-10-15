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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::resource('projects','ProjectController');
Route::resource('projects.milestones','MilestoneController');
Route::post('requirements/updateRate/{requirement}',[
    'uses'=>'RequirementController@updateRate',
    'as'=>'requirements.updateRate'
]);
Route::post('requirements/updatePercentage/{requirement}',[
    'uses'=>'RequirementController@updatePercentage',
    'as'=>'requirements.updatePercentage'
]);
Route::resource('requirements','RequirementController');
Route::resource('bugs','RequirementController');
Route::resource('users','UserController');
Route::resource('requirements.questions','QuestionController');
Auth::routes();
Route::resource('files','FileController');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
