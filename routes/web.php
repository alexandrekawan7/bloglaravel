<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::resource('/', PostController::class)->names([
  'index' => 'posts.index',
  'create' => 'posts.create',
  'store' => 'posts.store',
  'show' => 'posts.show'
]);

Route::get('{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');

Route::delete('{id}', [PostController::class, 'destroy'])->name('posts.destroy');