<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Chuyển hướng Socialite
Route::get('/callback/{provider}', [AuthController::class, 'callback']);

// Xem thử email
Route::get('/mail', function() {
    return view('mail.register', ['user' => '']);
});