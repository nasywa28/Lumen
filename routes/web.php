<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts',[PostsController::class, 'index']);
Route::post('posts',[PostsController::class, 'store']);
Route::get('posts/{id}',[PostsController::class, 'edit']);
Route::put('posts/{id}',[PostsController::class, 'update']);
Route::delete('posts/{id}',[PostsController::class,'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin-page',[App\Http\Controllers\HomeController::class, 'indexAdmin'])->middleware('role:admin')->name('admin.page');
Route::get('user-page', [App\Http\Controllers\HomeController::class, 'indexUser'])->middleware('role:user')->name('user.page');
