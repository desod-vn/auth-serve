<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;


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

    // Đăng nhập Socialite
    Route::get('/auth/{provider}', [AuthController::class, 'redirect']);

    // Quên mật khẩu
    Route::post('/forgot', [AuthController::class, 'forgot']);
});

Route::group(['middleware' => 'auth:api'], function() {
    // Đăng xuất
    Route::post('/logout', [AuthController::class, 'logout']);

    // Thông tin người dùng
    Route::get('/user', [AuthController::class, 'user']);

    Route::prefix('user/{user}')->group(function () {
    
        // Mật khẩu mới
        Route::put('/new_password', [UserController::class, 'new_password']);

        // Thay ảnh đại diện
        Route::post('/avatar', [UserController::class, 'avatar']);

        // Đổi mật khẩu
        Route::put('/password', [UserController::class, 'password']);

        // Xem thông tin người khác
        Route::get('/information', [UserController::class, 'show']);

        // Sửa thông tin người dùng
        Route::put('/update', [UserController::class, 'update']);

        // Khóa tài khoản
        Route::delete('/delete', [UserController::class, 'destroy']);
    });
});