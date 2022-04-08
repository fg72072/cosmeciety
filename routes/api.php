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
        Route::post('profile/update', 'ProfileController@update');
        Route::post('profile/upload_media', 'ProfileController@upload_media');
        Route::post('profile/update/working-day/{id}', 'ProfileController@updateWorkingDays');

        Route::get('community-forum', 'CommunityController@index');
        Route::get('community-forum/{id}', 'CommunityController@show');
        Route::post('community-forum/create', 'CommunityController@store');
        Route::post('community-forum/comment/create/{id}', 'CommentController@storeTopicComment');

        Route::get('contest','ContestController@getContest');
        Route::post('contest/add-participant','ContestController@addParticipate');
        Route::get('contest/participant/{id}','ContestController@getParticipateViaContest');
        Route::post('participant/vote','ContestController@vote');
        Route::post('customer/post/comment/create/{id}', 'CommentController@storePostComment');

        Route::get('participant/{id}','ContestController@getParticipateById');
        Route::post('participant/add-feedback','ContestController@participateAddFeedback');
        Route::get('contest/winner','ContestController@getContestWinner');

        Route::post('promotion/add','PromotionController@addPromotion');
        Route::get('promotion','PromotionController@getPromotion');
        Route::get('promotion/delete/{id}','PromotionController@removePromotion');

        Route::get('notifications','NotificationController@index');

        

    });



    Route::group(['prefix'=>'customer','namespace' => 'Customer','middleware'=>['auth.jwt']], function () {
        Route::get('barbers', 'ServiceController@barber');
        Route::get('barber/{id}', 'ServiceController@showBarber');
        Route::get('services/{id}', 'ServiceController@showBarberService');

        Route::get('post', 'PostController@index');
        Route::get('post/{id}', 'PostController@show');
        Route::post('post/create', 'PostController@store');
        Route::post('post/like/{id}', 'PostController@like');

        Route::get('chat/{id}', 'ChatController@show');
        Route::post('chat/message/{id}', 'ChatController@store');
        Route::post('add-to-friend/{id}', 'FriendController@store');


        Route::get('favourite', 'FavouriteController@index');
        Route::post('add-to-favourite/{id}', 'FavouriteController@addToFavourite');
    });


    Route::group(['prefix' =>'barber' ,'namespace' => 'Barber','middleware'=>['auth.jwt']], function () {
        Route::get('service','ServiceController@index');
        Route::get('service/{id}','ServiceController@show');
        Route::post('service/add','ServiceController@store');
        Route::get('store','StoreController@store');
        Route::get('store/{id}','StoreController@showStore');

        Route::get('product','StoreController@product');

        Route::post('order','OrderController@store');
    });
});

