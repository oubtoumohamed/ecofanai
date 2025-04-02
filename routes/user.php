<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/user/'], function () {

        Route::get('list', [App\Http\Controllers\UserController::class, 'index'])
            ->name('user')
            ->middleware('Admin:USER_LIST');

        Route::get('vendors', [App\Http\Controllers\UserController::class, 'vendors'])
            ->name('user_vendors');
        
        Route::get('create', [App\Http\Controllers\UserController::class, 'create'])
            ->name('user_create')
            ->middleware('Admin:USER_CREATE');
        
        Route::post('create', [App\Http\Controllers\UserController::class, 'store'])
            ->name('user_store')
            ->middleware('Admin:USER_CREATE');
        
        Route::get('{id}', [App\Http\Controllers\UserController::class, 'show'])
            ->name('user_show')
            ->middleware('Admin:USER_SHOW')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])
            ->name('user_edit')
            ->middleware('Admin:USER_EDIT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', [App\Http\Controllers\UserController::class, 'update'])
            ->name('user_update')
            ->middleware('Admin:USER_EDIT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('user_delete')
            ->middleware('Admin:USER_DELETE')
            ->where('id', '[0-9]+');
        
        Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])
            ->name('user_profile');

        Route::post('profile', [App\Http\Controllers\UserController::class, 'update_profile'])
            ->name('user_update_profile');
    });
});