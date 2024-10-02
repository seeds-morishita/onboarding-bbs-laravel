<?php

use App\Http\Controllers\BoardController;

Route::controller(BoardController::class)->group(function () {
    Route::get('index', 'index')->name('index');
    Route::post('post_confirm', 'postConfirm')->name('post.confirm');
    Route::post('post_complete', 'postComplete')->name('post.complete');
    Route::post('edit/{id}', 'edit')->name('edit');
    Route::post('edit_complete', 'editComplete')->name('edit.complete');
    Route::post('delete_confirm', 'deleteConfirm')->name('delete.confirm');
    Route::post('delete_complete', 'deleteComplete')->name('delete.complete');
});

