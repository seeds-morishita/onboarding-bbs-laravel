<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ArticleController;

Route::get('boards/{article}/edit', [ArticleController::class, 'edit'])->name('boards.edit');
Route::post('/boards/{article}/edit_complete', [ArticleController::class, 'editComplete'])->name('boards.edit_complete');

Route::post('/boards/post_confirm', [ArticleController::class, 'postConfirm'])->name('boards.post_confirm');
Route::post('/boards/post_complete', [ArticleController::class, 'postComplete'])->name('boards.post_complete');

Route::get('boards/{article}/delete_confirm', [ArticleController::class, 'deleteConfirm'])->name('boards.delete_confirm');
Route::post('/boards/{article}/delete_complete', [ArticleController::class, 'deleteComplete'])->name('boards.delete_complete');

Route::get('index', [BoardController::class, 'index'])->name('index');


