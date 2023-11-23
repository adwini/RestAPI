<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\SuccesController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('forgotPassword', 'forgotPassword')->name('forgotPassword');
    // Route::get('resetUI', 'resetUI')->middleware('guest')->name('password.reset');
    // Route::post('resetPassword', 'resetPassword')->name('resetPassword');
});
Route::post('/resetpassword', [SuccesController::class, 'view']);
Route::get('/success', [SuccesController::class, 'view']);
//mo return ug view para mo hatag sa MAILER
// Route::get('/forgot-password', function () {
//     return view('auth\forgot-password');
// })->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth\reset_password', ['token' => $token]);
})->name('password.reset');

// Route::post('/reset-password', function (Request $request) {
//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:8|confirmed',
//     ]);

//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function (User $user, string $password) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->setRememberToken(Str::random(60));

//             $user->save();

//             event(new PasswordReset($user));
//         }
//     );

//     return $status === Password::PASSWORD_RESET
//                 ? redirect()->route('login')->with('status', __($status))
//                 : back()->withErrors(['email' => [__($status)]]);
// })->middleware('guest')->name('password.update');
