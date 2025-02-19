<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


Route::get('/test-email', function () {
    Mail::raw('E-mail de teste do Laravel via OpenSMTPD!', function ($message) {
        $message->to('waldenylsonwpss@fab.mil.br')->subject('Teste E-mail');
    });
    return 'E-mail enviado! Verifique o log do OpenSMTPD.';
});


Route::middleware('auth', 'verified')->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    })->middleware('verified');

    // Route::get('/teste', function () {
    //     return view('auth.verify-email');
    // });

    Route::get('/home', function () {
        return redirect('/dashboard');
    })->middleware(['auth', 'verified']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('usuarios')->group(function () {

        Route::get('/', [UserController::class, 'index']);
        Route::get('/novo', [UserController::class, 'create']);
        Route::post('/salvar', [UserController::class, 'store']);
    });


});


Route::get('verify-email/{id}/{hash}', function (Request $request) {

    // dd($request);

    $result = DB::table('users')
        ->where('id', $request->id)
        ->update(['email_verified_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);

    if ($result) {
        return view('auth.verify-email-confirmation')->with('message', 'E-mail validado com Sucesso!');
    }
})->name('verification.verify');

// Página para exibir o aviso de verificação (Route [verification.notice])
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Certifique-se de que a view auth.verify existe
})->middleware('auth')->name('verification.notice');


require __DIR__.'/auth.php';
