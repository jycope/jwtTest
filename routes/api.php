<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::post('register', [AuthController::class, 'register'])
        ->withoutMiddleware('auth:api');

    Route::post('login', [AuthController::class, 'login'])
        ->withoutMiddleware('auth:api');

    Route::get('notAuthorized', [AuthController::class, 'notAuthorized'])
        ->withoutMiddleware('auth:api')
        ->name('notAuthorized');
        
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::resource('news', NewsController::class)->except(['show', 'index']);
});

Route::get('news/{news}', [NewsController::class, 'show'])->name('news.destroy');
Route::get('news', [NewsController::class, 'index'])->name('news.index');
