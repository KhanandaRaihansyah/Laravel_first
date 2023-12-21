<?php

use App\Http\Controllers\mahasiswacontroller;
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
    return view('auth.login');
});

Route::resource('mahasiswa', mahasiswacontroller::class);

Auth::routes();
Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
