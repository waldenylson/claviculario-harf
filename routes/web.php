<?php

use App\Http\Controllers\UserController;
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
    return redirect('/dashboard');
})->middleware('verified');

Route::get('/teste', function () {
    return view('auth.verify-email');
});

Route::get('/home', function () {
    return redirect('/dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth', 'verified')->group(function () {

    Route::prefix('usuarios')->group(function () {

        Route::get('/novo', [UserController::class, 'create']);
        Route::post('/salvar', [UserController::class, 'store']);
    });


});

Route::get('/test-alert', function () {
    return redirect()->back()->with('message', 'minha Chibata!');
});

require __DIR__.'/auth.php';
