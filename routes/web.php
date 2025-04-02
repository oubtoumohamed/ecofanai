<?php

use Illuminate\Support\Facades\Route;

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
if (config('app.env') === 'production') {
    \URL::forceScheme('https');
}

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/take/', [App\Http\Controllers\HomeController::class, 'take'])->name('take');
	Route::post('/upload_video/', [App\Http\Controllers\HomeController::class, 'upload_video'])->name('upload_video');
	Route::get('/history/', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
	Route::get('/admin/', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
});

Route::group(['middleware' => 'auth','prefix' => '/admin/notification/'], function () {
	Route::get('{id}', [App\Http\Controllers\Controller::class, 'shownotif'])
		->name('notification_show')
		->where('id', '[0-9]+');
});

include 'user.php';
include 'groupe.php';