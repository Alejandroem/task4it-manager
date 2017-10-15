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

Route::post('files/create/{relation}/{relation_id}',[
    'uses'=>'FileController@createPost',
    'as'=>'files.createPost'
]);
Route::get('files/show/{file}',[
    'uses'=>'FileController@show',
    'as'=>'files.show'
]);
Route::get('files/{relation}/{relation_id}',[
    'uses'=>'FileController@index',
    'as'=>'files.index'
]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/info',function(){
    return dd(phpinfo());
});