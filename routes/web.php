<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
// Route::controller(ForgotPasswordController::class)->group(function () {
//     Route::post('forgotPassword', 'forgotPassword');
//     Route::post('resetPassword', 'resetPassword');
//     return view('auth\reset_password');
// });
// Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

