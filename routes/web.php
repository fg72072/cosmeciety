<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
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


Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('/', 'IndexController@index')->middleware(['role:seller|super-admin','permission:View']);
    Route::get('admin/404', function () {
        return view('404');
    });
    Route::group(['middleware' => ['role:seller|super-admin']], function () {

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index');
        Route::get('/create', 'ProductController@create');
        Route::post('/create', 'ProductController@store')->name('product.store');
        Route::get('/edit/{id}', 'ProductController@edit');
        Route::post('/update/{id}', 'ProductController@update');
        Route::post('/delete/{id}', 'ProductController@destroy');
    });

    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/create', 'InventoryController@create');
        Route::post('/create', 'InventoryController@store')->name('inventory.store');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::group(['middleware' => ['role:super-admin']], function () {
            Route::get('/', 'UserController@index');
            Route::get('/create', 'UserController@create');
            Route::post('/create', 'UserController@store')->name('user.store');
            Route::post('/delete/{id}', 'UserController@destroy');
        });
        Route::get('/edit/{id}', 'UserController@edit')->middleware('role:seller|super-admin');
        Route::post('/update/{id}', 'UserController@update')->middleware('role:seller|super-admin'); 
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->middleware('role:seller|super-admin');
        Route::group(['middleware' => ['role:super-admin']], function () {
            Route::get('/create', 'CategoryController@create');
            Route::post('/create', 'CategoryController@store')->name('category.store');
            Route::post('/delete/{id}', 'CategoryController@destroy');
            Route::get('/edit/{id}', 'CategoryController@edit');
            Route::post('/update/{id}', 'CategoryController@update');
        });
       
    });

    Route::group(['prefix' => 'order','middleware' => ['role:seller']], function () {
        Route::get('/', 'OrderController@index');
        Route::get('/edit/{id}', 'OrderController@edit');
        Route::post('/update/{id}', 'OrderController@update');
        Route::post('/delete/{id}', 'OrderController@destroy');
    });

    Route::group(['prefix' => 'topic','middleware' => ['role:super-admin']], function () {
        Route::get('/', 'TopicController@index');
        Route::get('/create', 'TopicController@create');
        Route::post('/create', 'TopicController@store')->name('topic.store');
        Route::get('/edit/{id}', 'TopicController@edit');
        Route::post('/update/{id}', 'TopicController@update');
        Route::post('/delete/{id}', 'TopicController@destroy');
    });

    Route::group(['prefix' => 'wall','middleware' => ['role:super-admin']], function () {
        Route::get('/', 'WallController@index');
        Route::get('/create', 'WallController@create');
        Route::post('/create', 'WallController@store')->name('wall.store');
        Route::get('/edit/{id}', 'WallController@edit');
        Route::post('/update/{id}', 'WallController@update');
        Route::post('/delete/{id}', 'WallController@destroy');
    });

    Route::group(['prefix' => 'contest','middleware' => ['role:super-admin']], function () {
        Route::get('/', 'ContestController@index');
        Route::get('/create', 'ContestController@create');
        Route::post('/create', 'ContestController@store')->name('contest.store');
        Route::get('/edit/{id}', 'ContestController@edit');
        Route::post('/update/{id}', 'ContestController@update');
        Route::post('/delete/{id}', 'ContestController@destroy');
    });

    Route::group(['prefix' => 'comment','middleware' => ['role:super-admin']], function () {
        Route::get('/edit/{id}', 'CommentController@edit');
        Route::post('/update/{id}', 'CommentController@update');
        Route::post('/delete/{id}', 'CommentController@destroy');
    });

    Route::group(['prefix' => 'transaction','middleware' => ['role:super-admin']], function () {
        Route::get('/', 'TransactionController@index');
    });


    Route::fallback(function() {
        return redirect('admin/404');
    });
    });
    
});
