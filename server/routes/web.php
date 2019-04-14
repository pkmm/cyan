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


Route::get('/', 'HomeController@index');

// 微信
Route::any('/wechat', 'WeChatController@serve');

Route::any('/test', 'TestController@test')->middleware(['response_wrapper']);

/////////////////////////////
/// hahaha
/////////////////////////////

Route::group(['middleware' => 'auth_user:USER, response_wrapper', 'prefix' => 'v1'], function () {
    Route::post('/wx/login', 'WeChatController@wxLogin');
    Route::get('/student/scores', 'StudentController@getScores');
});

Route::get('v1/zcmu/new_infos/{id?}', 'ZcmuController@getNewInfos')
    ->where('id', '[0-9]+')
    ->middleware(['auth_user:ANONYMOUS', 'response_wrapper']);
