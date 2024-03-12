<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\captchacontroller;
use App\Http\Controllers\mailcontroller;
use App\Http\Controllers\ProfileController;

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
Route::get('/', function(){
   return view('welcome');
});




Route::group(['middleware' => 'guest'], function(){
Route::get('/login', [authcontroller::class, 'login'])->name('login');
Route::post('/login', [authcontroller::class, 'postlogin'])->name('login.post');
Route::get('/registration', [authcontroller::class, 'register'])->name('registration');
Route::post('/registration', [authcontroller::class, 'postregister'])->name('registration.store');

});

Route::get('/forgot',[mailcontroller::class,'forgot'])->name('forgot');
Route::post('/forgot', [mailcontroller::class, 'postforgot'])->name('forgot.post');





Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [authcontroller::class, 'home'])->name('home');
    Route::get('/logout', [authcontroller::class, 'logout'])->name('logout');
    
});


Route::get('/',[captchacontroller::class,'index']);

Route::get('/reload-captcha',[captchacontroller::class,'reloadcaptcha']);



