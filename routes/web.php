<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutosController;

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


Route::group(['middleware' => 'web'], function () {

    Route::view('/', 'welcome')->name('welcome');
    Route::view('/login', 'login')->name('login');

    Route::resource('/produtos', ProdutosController::class);
    Route::resource('/dashboard', DashboardController::class);
    // Route::resource('/user', UserController::class)->except(['index']);

    // Route::get('/clientes', [ClienteController::class, 'index'])->middleware('role:admin')->name('clientes.index');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    // Route::get('/logout', [ClienteController::class, 'logout'])->name('clientes.logout');
    // Route::post('/pagamentos/{pagamento}', [PagamentoController::class, 'Executar'])->name('pagamentos.executar');
});