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

Route::get('/',[
    'uses'=> 'PackageController@index',
    'as'=>'home'
]);

Route::get('/projects/export',[
    'uses'=>'ProjectController@exportRequirements',
    'as'=>'project.export'
]);
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

Route::post('requirements/status/{requirement}',[
    'uses'=>'RequirementController@changeStatus',
    'as'=>'requirements.status'
]);
Route::resource('requirements','RequirementController');
Route::resource('bugs','RequirementController');

Route::post('users/endis/{user}',[
    'uses'=>'UserController@endis',
    'as'=>'users.endis'
]);
Route::resource('users','UserController');


Route::resource('payments','PaymentController');


Route::get('notifications/display',[
    'uses'=>'NotificationController@display',
    'as'=>'notifications.display'
]);
Route::post('notifications/check',[
    'uses'=>'NotificationController@check',
    'as'=>'notifications.check'
]);

Route::get('notifications/list/{user}',[
    'uses'=>'NotificationController@listNotifications',
    'as'=>'notifications.list'
]);

Route::resource('notifications','NotificationController');
Route::resource('requirements.questions','QuestionController');
Auth::routes();


Route::group(['middleware' => config('laradrop.middleware') ? config('laradrop.middleware') : null], function () {
    
    Route::get('laradrop/containers', [
        'as' => 'laradrop.containers',
        'uses' => '\Jasekz\Laradrop\Http\Controllers\LaradropController@getContainers'
    ]);
    
    Route::post('laradrop/move', [
        'as' => 'laradrop.move',
        'uses' => '\Jasekz\Laradrop\Http\Controllers\LaradropController@move'
    ]);
    
    Route::post('laradrop/create', [
        'as' => 'laradrop.create',
        'uses' => '\Jasekz\Laradrop\Http\Controllers\LaradropController@create'
    ]);
    
    Route::resource('laradrop', '\Jasekz\Laradrop\Http\Controllers\LaradropController');
    
});

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
Route::post('files',[
    'uses'=>'FileController@store',
    'as'=>'files.store'
]);
Route::post('files/update/{file}',[
    'uses'=>'FileController@update',
    'as'=>'files.update'
]);
Route::delete('files/destroy/{file}',[
    'uses'=>'FileController@destroy',
    'as'=>'files.destroy'
]);

Route::resource('/requirement/names','RequirementNameController');

Route::get('/proposal/export/{proposal}',[
    'uses'=>'ProposalController@export',
    'as'=>'proposal.export'
]);
Route::resource('/proposal','ProposalController');


Route::get('/budgets/{budget}/export',[
    'uses'=>'BudgetController@export',
    'as'=>'budgets.export'
]);
Route::resource('/budgets','BudgetController');

Route::resource('/packages','PackageController');
Route::resource('/options','PackageOptionController');
Route::resource('/values','OptionValueController');
Route::resource('/enquires','EnquireController');