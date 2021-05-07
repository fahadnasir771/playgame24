<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group([
    'middleware' => 'auth'
], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/gen', [App\Http\Controllers\HomeController::class, 'gen'])->name('gen');
    Route::post('/store', [App\Http\Controllers\ReceiptController::class, 'store'])->name('create_receipt');
    Route::delete('/del/{id}', [App\Http\Controllers\ReceiptController::class, 'destroy'])->name('delete_receipt');
    Route::get('/get-max', [App\Http\Controllers\ReceiptController::class, 'get_max'])->name('get_max');

});


