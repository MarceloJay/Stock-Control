<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiProdutos;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    Route::get('/session', [SessionController::class, 'session'])->name('session');
    
    // Route::get('/create', [ApiProdutos::class, 'create'])->name('produtos.create');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/users/{userId}', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);
});

Route::post('/create', [ApiProdutos::class, 'create'])->name('produtos.create');
Route::get('/show', [ApiProdutos::class, 'show'])->name('produtos.show');
Route::get('/session', [SessionController::class, 'session'])->name('session');


// /Api/orders (max. 120 requests per minute)
Route::group(['prefix' => 'produtos', 'middleware' => 'customthrottle:120'], function() {
    Route::put('/new', 'ApiProdutos@create'); // Insert Order | OK @ 2020-11-17
    Route::post('/update', 'ApiOrders@update'); // Update Order | OK @ 2021-12-06
    Route::get('/list/{since}', 'ApiOrders@list'); // List Orders | OK @ 2020-11-17
    Route::get('/listTicket/{since}', 'ApiOrders@listTicket');  // List Orders | OK @ 2020-11-17
});