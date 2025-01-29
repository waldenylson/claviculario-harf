<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/test-email', function () {
    Mail::raw('E-mail de teste do Laravel via OpenSMTPD!', function ($message) {
        $message->to('waldenylsonwpss@fab.mil.br')->subject('Teste E-mail');
    });
    return 'E-mail enviado! Verifique o log do OpenSMTPD.';
});

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

        Route::get('/', [UserController::class, 'index']);
        Route::get('/novo', [UserController::class, 'create']);
        Route::post('/salvar', [UserController::class, 'store']);
    });


});

// Route::get('/test-email', function () {

//     $msg = "First line of text\nSecond line of text";

//     // use wordwrap() if lines are longer than 70 characters
//     $msg = wordwrap($msg, 70);

//     // send email
//     mail("waldenylsonwpss@fab.mil.br", "Teste E-mail", $msg);

//     return redirect()->back()->with('message', 'minha Chibata!');
// });

require __DIR__.'/auth.php';
