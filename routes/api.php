<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::group(['middleware' => 'guest'], function() {
    // Đăng ký
    Route::post('/register', [AuthController::class, 'register']);

    // Đăng nhập
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/test', [AuthController::class, 'test']);

Route::group(['middleware' => 'auth:api'], function() {
    // Đăng xuất
    Route::post('/logout', [AuthController::class, 'logout']);

    // Thông tin người dùng
    Route::get('/user', [AuthController::class, 'user']);
});