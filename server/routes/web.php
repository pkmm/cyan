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

///*微信相关的*/
//Route::group(['prefix' => 'wechat'], function () {
//
//    Route::get('/', 'WeChatController@check');
//    Route::post('/', 'WeChatController@post');
//
//});
// /*zcmu相关的*/
// Route::group(['prefix' => 'zcmu'], function () {
//     Route::get('/getScore', 'ZcmuController@getScore');
//     Route::get('/zf', 'ZcmuController@tep');
// });
//
// /*贴吧相关的*/
// Route::group(['prefix' => 'tieba'], function () {
//     Route::get("/getTiebas", 'TiebaController@getTiebas');
// });

// Route::any('/zcc', function () {
//     \App\Http\Controllers\ZcmuController::test();
// });


// 微信
Route::any('/wechat', 'WeChatController@serve');

// Route::group(['middleware' => ['wechat.oauth']], function () {
//     Route::get('/user', function () {
//         $user = session('wechat.oauth_user.default');
//
//         dd($user);
//     });
// });


Route::any('/test', 'TestController@test');

// end wechat

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
