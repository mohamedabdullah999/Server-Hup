<?php


use App\Http\Controllers\SessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SelLanguage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ServerController;
use App\Models\Server;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/change', [SelLanguage::class,'change'])->name('lang.change');

Route::get('/register', [RegisterController::class,'show'])->middleware('guest')->name('register.show');
Route::post('/register', [RegisterController::class,'store'])->middleware('guest');

Route::get('/login', [SessionController::class , 'show'])->middleware('guest')->name('login');
Route::post('/login' , [SessionController::class,'store'])->middleware('guest');
Route::post('/logout', [SessionController::class,'destroy'])->name('logout');

Route::get('auth/google/redirect',[GoogleController::class,'redirectToGoogle'])->middleware('guest')->name('kick.google');
Route::get('auth/google/callback',[GoogleController::class,'handleGoogleCallback'])->middleware('guest')->name('fetch.google');


Route::get('/servers' , [ServerController::class,'index'])->middleware('auth')->name('servers.index');
Route::get('/servers/create' , [ServerController::class,'create'])->middleware('auth')->can('create-server')->name('servers.create');
Route::post('/servers' , [ServerController::class,'store'])->middleware('auth')->can('create-server')->name('servers.store');
Route::get('/servers/{server}' , [ServerController::class,'show'])->middleware('auth')->can('show-server' , 'server')->name('servers.show');
Route::get('/servers/{server}/edit' , [ServerController::class,'edit'])->middleware('auth')->can('edit-server' , 'server')->name('servers.edit');
Route::put('/servers/{server}' , [ServerController::class,'update'])->middleware('auth')->can('edit-server' , 'server')->name('servers.update');
Route::delete('/servers/{server}' , [ServerController::class,'destroy'])->middleware('auth')->can('edit-server' , 'server')->name('servers.destroy');
Route::post('/servers/{server}' , [ServerController::class , 'join'])->middleware('auth')->name('servers.join');

Route::get('/servers/{server}/posts/create', [PostController::class, 'create'])->middleware('auth')->can('edit-server', 'server')->name('posts.create');
Route::post('/servers/{server}/posts', [PostController::class, 'store'])->middleware('auth')->can('edit-server', 'server')->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth')->can('edit-post', 'post')->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth')->can('update-post', 'post')->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth')->can('delete-post', 'post')->name('posts.destroy');
Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->middleware('auth')->name('comments.store');
