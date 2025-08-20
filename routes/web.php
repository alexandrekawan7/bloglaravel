<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::resource('/', PostController::class)->names([
  'index' => 'posts.index',
  'create' => 'posts.create',
  'store' => 'posts.store',
  'show' => 'posts.show',
]);