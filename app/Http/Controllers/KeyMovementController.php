<?php

namespace App\Http\Controllers;

use App\Http\Repositories\KeyMovement\KeyMovementRepository;
use App\Http\Requests\StoreKeyMovementPostRequest;
use App\Models\Key;
use App\Models\HarfStaff;
use App\Models\User;

class KeyMovementController extends Controller
{
  private KeyMovementRepository $keyMovementRepository;

  public function __construct(KeyMovementRepository $repository)
  {
    $this->keyMovementRepository = $repository;
  }

  public function index()
  {
    $movements = $this->keyMovementRepository->listMovements(true);

    return view('key_movements.index')->with(compact('movements'));
  }

  public function create()
  {
    $keys = Key::all();
    $staff = HarfStaff::all();
    $users = User::all();
    return view('key_movements.new')->with(compact('keys', 'staff', 'users'));
  }

  public function store(StoreKeyMovementPostRequest $request)
  {
    $result = $this->keyMovementRepository->store($request);

    if ($result) {
      return redirect()->back()->with('message', 'Movimentação de Chave Inserida com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Inserir a Movimentação de Chave!');
  }

  public function edit($id)
  {
    $movement = $this->keyMovementRepository->edit($id);
    $keys = Key::all();
    $staff = HarfStaff::all();
    $users = User::all();
    return view('key_movements.edit')->with(compact('movement', 'keys', 'staff', 'users'));
  }

  public function update(StoreKeyMovementPostRequest $request, $id)
  {
    $result = $this->keyMovementRepository->persistUpdate($request, $id);

    if ($result) {
      return redirect()->back()->with('message', 'Movimentação de Chave Atualizada com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Atualizar a Movimentação de Chave!');
  }

  public function destroy($id)
  {
    $result = $this->keyMovementRepository->destroy($id);

    if ($result) {
      return redirect()->back()->with('message', 'Movimentação de Chave Removida com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Remover a Movimentação de Chave!');
  }
}
