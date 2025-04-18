<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Efetivo\EfetivoRepository;
use App\Http\Repositories\KeyMovement\KeyMovementRepository;
use App\Http\Repositories\Keys\KeyRepository as KeysKeyRepository;
use App\Http\Repositories\Users\UserRepository;
use App\Http\Requests\StoreKeyMovementPostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\HarfStaff as Efetivo;
use Illuminate\Support\Facades\Hash;

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
  ) {
    $this->keyMovementRepository = $repository;
    $this->keyRepository = $keyRepository;
    $this->efetivoRepository = $efetivoRepository;
    $this->userRepository = $userRepository;
  }

  public function index()
  {
    $movements = $this->keyMovementRepository->listMovements(true);
    $staff = $this->efetivoRepository->listStaff(false);

    return view('key_movements.index')->with(compact('movements', 'staff'));
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
    $reservedKeys = $this->keyRepository->listReservedKeys()->pluck('department_id', 'id');

    $selectedReservedKeys = [];

    DB::beginTransaction();

    try {
      $user = Auth::user();
      $electronicSignature = $request->input('electronic_signature');

      // Verificar a assinatura eletrônica
      $harfStaff = Efetivo::where('id', $request->input('efetivo_id'))->first();

      if (!$harfStaff || !Hash::check($electronicSignature, $harfStaff->electronic_signature)) {
        return redirect()->back()->withInput()->with('error', 'Assinatura eletrônica inválida!');
      }

      $keyIds = $request->input('keys', []);

      foreach ($keyIds as $keyId) {
        $key = $this->keyRepository->findSingleKey($keyId);

        if (isset($reservedKeys[$keyId]) && $reservedKeys[$keyId] !== $harfStaff->department_id) {
          $selectedReservedKeys[] = $key->number;
          // return redirect()->back()->withInput()->with('error', 'Chave reservada para outro departamento!');

        }

        $data = [
          'key_id' => $keyId,
          'harf_staff_id' => $harfStaff->id,
          'user_id' => $user->id,
          'out' => $request->input('out') ?? now(),
          'return' => $request->input('return'),
          'comments' => $request->input('comments'),
        ];

        $result = \App\Models\KeyMovement::create($data);

        if (!$result) {
          DB::rollBack();
          return redirect()->back()->withInput()->with('error', 'Erro ao Tentar Inserir a Movimentação de Chave!');
        }
      }

      DB::commit();
      if (!empty($selectedReservedKeys)) {
        $selectedReservedKeysList = implode(', ', $selectedReservedKeys);
        return redirect()->back()->with('message', 'Movimentação de Chave Inserida com Sucesso!' . ' Chave(s) reservada(s) Lacrada(s): ' . $selectedReservedKeysList);
      }
      return redirect()->back()->with('message', 'Movimentação de Chave Inserida com Sucesso!');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withInput()->with('error', 'Erro ao Tentar Inserir a Movimentação de Chave: ' . $e->getMessage());
    }
  }

  public function returnIndividualKey(int $id)
  {
    $result = $this->keyMovementRepository->persistUpdate($request, $id);

    if ($result) {
      return redirect()->back()->with('message', 'Movimentação de Chave Atualizada com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Atualizar a Movimentação de Chave!');
  }

  public function returnKeysBath()
  {
    DB::beginTransaction();

    try {
      $user = Auth::user();
      $electronicSignature = $request->input('electronic_signature');

      // Verificar a assinatura eletrônica
      $harfStaff = Efetivo::where('id', $request->input('efetivo_id'))->first();

      if (!$harfStaff || !Hash::check($electronicSignature, $harfStaff->electronic_signature)) {
        return redirect()->back()->withInput()->with('error', 'Assinatura eletrônica inválida!');
      }

      // dd($request->input());

      $keyIds = $request->input('keys', []);

      dd($keyIds, $id);

      foreach ($keyIds as $keyId) {
        $keyMovement = $this->keyMovementRepository
          ->findActiveMovementByKeyAndStaff($keyId, $harfStaff->id);

        if (!$keyMovement) {
          return redirect()->back()->withInput()->with('error', 'Movimentação ativa não encontrada para a chave selecionada!');
        }

        $keyMovement->update([
          'harf_staff_return_id' => $harfStaff->id,
          'user_return_id' => $user->id,
          'return' => $request->input('return') ?? now(),
        ]);
      }

      DB::commit();
      return redirect()->back()->with('message', 'Devolução de Chave Registrada com Sucesso!');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withInput()->with('error', 'Erro ao Tentar Registrar a Devolução de Chave: ' . $e->getMessage());
    }
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
