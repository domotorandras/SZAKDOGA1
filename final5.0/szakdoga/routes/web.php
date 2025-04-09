<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\GuessrController;
use App\Http\Controllers\AuthController;

Route::get('/',        function () {return view(   'home');})->name('home');
Route::get('/profile', function () {return view('profile');})->name('profile');
Route::get('/manual',  function () {return view( 'manual');})->name('manual');


Route::get('/districts',    [DistrictController::class,    'game'])->name('districts');
Route::get('/subdistricts', [SubDistrictController::class, 'game'])->name('subdistricts');
Route::get('/guessr',       [GuessrController::class,      'game'])->name('guessr');

Route::get('/districtsleaderboard',    [DistrictController::class,    'leaderboard'])->name('districts.leaderboard');
Route::get('/subdistrictsleaderboard', [SubDistrictController::class, 'leaderboard'])->name('subdistricts.leaderboard');
Route::get('/guessrleaderboard',       [GuessrController::class,      'leaderboard'])->name('guessr.leaderboard');


Route::post('/districts',   [DistrictController::class,    'store'])->name('districts.store');
Route::post('/subdistricts',[SubDistrictController::class, 'store'])->name('subdistricts.store');
Route::post('/guessr',      [GuessrController::class,      'store'])->name('guessr.store');


Route::get('/register',  [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',     [AuthController::class,    'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class,     'register'])->name('register');
Route::post('/login',    [AuthController::class,        'login'])->name('login');
Route::post('/logout',   [AuthController::class,       'logout'])->name('logout');



