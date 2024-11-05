<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('all-post',[PostController::class, 'index'])->name('allpost');
Route::post('all-post',[PostController::class, 'store'])->name('allpost');

Route::get('create-post',[PostController::class, 'create'])->name('createpost');
Route::get('single-post/{post}',[PostController::class, 'show'])->name('showpost');
Route::get('edit-post/{post}',[PostController::class, 'edit'])->name('editpost');
Route::delete('delete-post/{post}',[PostController::class, 'destroy'])->name('deletepost');
