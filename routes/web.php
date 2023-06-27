<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    // Route::get('welcome_first', 'LoginController@welcome_first')->name('welcome_first');
    // Route::get('welcome_first', [LoginController::class, 'welcome_first'])->name('welcome_first');

    // Route::get('/login', [LoginController::class, 'login'])->name('login');
    // Route::post('login', 'LoginController@login');
    // Route::get('logout', 'LoginController@logout')->name('logout');
});

// Route::get('session', 'SessionController@session')->name('session');


Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');


