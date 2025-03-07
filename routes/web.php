<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EfetivoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\KeyController;
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


Route::middleware('auth')->group(function () {

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
    Route::post('/salvar', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/editar/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/atualizar/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/excluir/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
  });

  Route::prefix('efetivo')->group(function () {

    Route::get('/', [EfetivoController::class, 'index']);
    Route::get('/novo', [EfetivoController::class, 'create']);
    Route::post('/salvar', [EfetivoController::class, 'store'])->name('efetivo.store');
    Route::get('/editar/{id}', [EfetivoController::class, 'edit'])->name('efetivo.edit');
    Route::put('/atualizar/{id}', [EfetivoController::class, 'update'])->name('efetivo.update');
    Route::delete('/excluir/{id}', [EfetivoController::class, 'destroy'])->name('efetivo.destroy');
  });

  Route::prefix('secao')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/novo', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/salvar', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/editar/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/atualizar/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/excluir/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
  });

  Route::prefix('chaves')->group(function () {
    Route::get('/', [KeyController::class, 'index'])->name('keys.index');
    Route::get('/novo', [KeyController::class, 'create'])->name('keys.create');
    Route::post('/salvar', [KeyController::class, 'store'])->name('keys.store');
    Route::get('/editar/{id}', [KeyController::class, 'edit'])->name('keys.edit');
    Route::put('/atualizar/{id}', [KeyController::class, 'update'])->name('keys.update');
    Route::delete('/excluir/{id}', [KeyController::class, 'destroy'])->name('keys.destroy');
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


require __DIR__ . '/auth.php';
