<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\BlcUploadFrnController;



/*
| Redirect Root
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('blc-upload-frns.index');   // ← Langsung ke Index BLC
    }
    return redirect('/login');
});


/*
| Login
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('blc-upload-frns', BlcUploadFrnController::class);

    Route::patch('blc-upload-frns/{blc_upload_frn}/update-blc',
        [BlcUploadFrnController::class, 'updateBlc'])
        ->name('blc-upload-frns.update-blc');

    // Route Copy
    Route::post('blc-upload-frns/{blc_upload_frn}/copy', 
        [BlcUploadFrnController::class, 'copy'])
        ->name('blc-upload-frns.copy');
});

Route::get('/dashboard', function () {
    return redirect()->route('blc-upload-frns.index');
})->name('dashboard');