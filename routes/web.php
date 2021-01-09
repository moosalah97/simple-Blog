<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\PagesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\PostController::class, 'index']);


//route views pages
/*
route::get('about',function(){
    return view ('pages.about');
});

 route::get('services',function(){
     return view('pages.services');
 });

route::get('about',function(){
    return view('pages.about');
});*/
//route method from controller
Route::get('/about', [PagesController::class, 'about']);
Route::get('/home', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/services', [PagesController::class, 'services']);


Route::get ('/posts', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/posts/create',[\App\Http\Controllers\PostController::class, 'create']);
Route::post('/posts',[\App\Http\Controllers\PostController::class, 'store']);
Route::get('/posts/{id}',[\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/destroy/{id}',[\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/edit',[\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/update/{id}',[\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');

//comments route
Route::get('/comment/{id}',[\App\Http\Controllers\CommentsController::class,'store' ])->name('comments.store');
Route::delete('/comments/destroy/{id}',[\App\Http\Controllers\CommentsController::class, 'destroy'])->name('comments.destroy');
Route::get('/posts/comments_edit/{id}',[\App\Http\Controllers\CommentsController::class, 'edit'])->name('comments.edit');
Route::put('/comment/update/{id}',[\App\Http\Controllers\CommentsController::class, 'update'])->name('comment.update');



Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
