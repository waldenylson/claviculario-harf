<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Efetivo\EfetivoRepository;
use App\Http\Repositories\KeyMovement\KeyMovementRepository;
use App\Http\Repositories\Keys\KeyRepository as KeysKeyRepository;
use App\Http\Repositories\Users\UserRepository;
use App\Http\Requests\StoreKeyMovementPostRequest;

class KeyMovementController extends Controller
{
  private KeysKeyRepository $keyRepository;
  private KeyMovementRepository $keyMovementRepository;
  private EfetivoRepository $efetivoRepository;
  private UserRepository $userRepository;

  public function __construct(
    KeyMovementRepository $repository,
    KeysKeyRepository $keyRepository,
    EfetivoRepository $efetivoRepository,
    UserRepository $userRepository
  )
  {
    $this->keyMovementRepository = $repository;
    $this->keyRepository = $keyRepository;
    $this->efetivoRepository = $efetivoRepository;
    $this->userRepository = $userRepository;
  }

  public function index()
  {
    $movements = $this->keyMovementRepository->listMovements(true);

    return view('key_movements.index')->with(compact('movements'));
  }

  public function create()
  {
    $keys = $this->keyRepository->listKeys();
    $staff = $this->efetivoRepository->listStaff(true);
    $users = $this->userRepository->listUsers(true);

    return view('key_movements.new')->with(compact('keys', 'staff', 'users'));
  }

  public function store(StoreKeyMovementPostRequest $request)
  {
    // dd($request->all());

    $result = $this->keyMovementRepository->store($request);

    if ($result) {
      return redirect()->back()->with('message', 'Movimentação de Chave Inserida com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Inserir a Movimentação de Chave!');
  }

  public function edit($id)
  {
    $movement = $this->keyMovementRepository->edit($id);
    $keys = $this->keyRepository->listKeys();
    $staff = $this->efetivoRepository->listStaff();
    $users = $this->userRepository->listUsers();

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
