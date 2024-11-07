<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrivateController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'indexone'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('dashboard',[PrivateController::class, 'index'])->name('dashboard');
Route::get('user-add',[PostController::class, 'createStory'])->name('createstory');

//saveuser
Route::post('save-uset',[PrivateController::class, 'addUser'])->name('addUser');


Route::view('create-account', 'createaccount')->name('createaccount');
Route::get('all-post',[PostController::class, 'index'])->name('allpost');
Route::post('all-post',[PostController::class, 'store'])->name('allpost');


Route::get('create-post',[PostController::class, 'create'])->name('createpost');
Route::get('single-post/{post}',[PostController::class, 'show'])->name('showpost');

Route::get('view-story/{post}',[PostController::class, 'View'])->name('viewpost');



Route::get('edit-post/{post}',[PostController::class, 'edit'])->name('editpost');
Route::delete('delete-post/{post}',[PostController::class, 'destroy'])->name('deletepost');

Route::put('update-post/{post}',[PostController::class, 'update'])->name('updatepost');
