<?php
use App\Http\Controllers\ArticleController;

Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/articles/{article}/edit_complete', [ArticleController::class, 'editComplete'])->name('articles.edit_complete');

Route::post('/articles/post_confirm', [ArticleController::class, 'postConfirm'])->name('articles.post_confirm');
Route::post('/articles/post_complete', [ArticleController::class, 'postComplete'])->name('articles.post_complete');

Route::get('articles/{article}/delete_confirm', [ArticleController::class, 'deleteConfirm'])->name('articles.delete_confirm');
Route::post('/articles/{article}/delete_complete', [ArticleController::class, 'deleteComplete'])->name('articles.delete_complete');

Route::get('index', [ArticleController::class, 'index'])->name('index');