<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.jwt')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('forme', 'AuthController@forme');
    Route::post('register', 'AuthController@register');
    Route::post('reset', 'AuthController@reset');
    Route::post('otp/send', 'OtpController@send');
    Route::post('otp/verify', 'OtpController@otpVerify');

    Route::group(['middleware'=>['auth.jwt']], function () {
        Route::get('community-forum', 'CommunityController@index');
        Route::get('community-forum/{id}', 'CommunityController@show');
        Route::post('community-forum/create', 'CommunityController@store');
        Route::post('community-forum/comment/create/{id}', 'CommentController@storeTopicComment');

        Route::get('post', 'PostController@index');
        Route::get('post/{id}', 'PostController@show');
        Route::post('post/create', 'PostController@store');
        Route::post('post/comment/create/{id}', 'CommentController@storePostComment');
    });


    Route::group(['prefix'=>'customer','namespace' => 'Customer','middleware'=>['auth.jwt']], function () {
        Route::get('barbers', 'ServiceController@barber');
        Route::get('barber/{id}', 'ServiceController@showBarber');
        Route::get('services/{id}', 'ServiceController@showBarberService');
    });


    Route::group(['prefix' =>'barber' ,'namespace' => 'Barber','middleware'=>['auth.jwt']], function () {
        Route::get('service','ServiceController@Index');
        Route::post('service/add','ServiceController@store');
    });
});

