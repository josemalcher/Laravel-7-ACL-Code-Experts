<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ThreadController;


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
    return redirect()->route('threads.index');
});

Route::group(['middleware' => 'access.control.list'], function () {
    Route::resource('threads', ThreadController::class);
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/replies/store', [App\Http\Controllers\ReplyController::class, 'store'])->name('replies.store');

// 'middleware' => 'auth','namespace' => 'Manager',
Route::group(['namespace' => 'Manager', 'prefix' => 'manager'], function () {
    Route::get('/', function () {
        return redirect()->route('users.index');
    });

    Route::resource('roles',    RoleController::class);
    Route::get('roles/{role}/resources', [RoleController::class, 'syncResources'])->name('roles.resources');
    Route::put('roles/{role}/resources', [RoleController::class, 'updateSyncResources'])->name('roles.resources.update');

    Route::resource('users', UserController::class);
    Route::resource('resources', ResourceController::class);
});
/*
Route::group(['middleware' => 'auth', 'namespace' => 'Manager', 'prefix' => 'manager'], function(){
    Route::get('/', function(){
        return redirect()->route('users.index');
    });

    Route::resource('roles', 'RoleController');
    Route::get('roles/{role}/resources', 'RoleController@syncResources')->name('roles.resources');
    Route::put('roles/{role}/resources', 'RoleController@updateSyncResources')->name('roles.resources.update');

    Route::resource('users', 'UserController');
    Route::resource('resources', 'ResourceController');
});*/
