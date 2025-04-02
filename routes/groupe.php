<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/groupe/'], function () {

        Route::get('list', [App\Http\Controllers\GroupeController::class, 'index'])
            ->name('groupe')
            ->middleware('Admin:GROUPE_LIST');
        
        Route::get('create', [App\Http\Controllers\GroupeController::class, 'create'])
            ->name('groupe_create')
            ->middleware('Admin:GROUPE_CREATE');
        
        Route::post('create', [App\Http\Controllers\GroupeController::class, 'store'])
            ->name('groupe_store')
            ->middleware('Admin:GROUPE_CREATE');
        
        Route::get('{id}', [App\Http\Controllers\GroupeController::class, 'show'])
            ->name('groupe_show')
            ->middleware('Admin:GROUPE_SHOW')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', [App\Http\Controllers\GroupeController::class, 'edit'])
            ->name('groupe_edit')
            ->middleware('Admin:GROUPE_EDIT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', [App\Http\Controllers\GroupeController::class, 'update'])
            ->name('groupe_update')
            ->middleware('Admin:GROUPE_EDIT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/delete', [App\Http\Controllers\GroupeController::class, 'destroy'])
            ->name('groupe_delete')
            ->middleware('Admin:GROUPE_DELETE')
            ->where('id', '[0-9]+');
    });
});