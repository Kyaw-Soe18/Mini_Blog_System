<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;

Route::redirect('/','/blogs');

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogList');
Route::post('/blogs/create', [BlogsController::class, 'create'])->name('blogCreate');
Route::get('blogs/delete/{id}',[BlogsController::class, 'delete'])->name('blogDelete');
Route::get('blogs/details/{id}', [BlogsController::class, 'detail'])->name('blogDetail');
Route::get('blogs/edit/{id}', [BlogsController::class, 'edit'])->name('blogEdit');
Route::post('blogs/update', [BlogsController::class, 'update'])->name('blogUpdate');