<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts',\App\Http\Controllers\PostController::class);
    Route::get('posts/tags/{tag_name}',[\App\Http\Controllers\PostController::class,'findByTag'])->name('posts.tags');
    Route::get('my-posts',[\App\Http\Controllers\PostController::class,'userPosts'])->name('user.posts');
    Route::resource('tags',\App\Http\Controllers\TagController::class);
    Route::get('comments',[\App\Http\Controllers\CommentController::class,'index'])->name('comments.index');
    Route::post('comments',[\App\Http\Controllers\CommentController::class,'store'])->name('comments.store');
    Route::post('comments/{id}/approve',[\App\Http\Controllers\CommentController::class,'approve'])->name('comments.approve');
    Route::get('comments/{id}/edit',[\App\Http\Controllers\CommentController::class,'edit'])->name('comments.edit');
    Route::delete('comments/{id}',[\App\Http\Controllers\CommentController::class,'destroy'])->name('comments.destroy');
    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::get('motionless-users',[\App\Http\Controllers\UserController::class,'blindUsers'])->name('blindUsers');

});

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('public.index');

Route::get('play',function (){

});

require __DIR__.'/auth.php';
