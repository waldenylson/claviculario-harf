<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
  protected string $modelClass = User::class;


  public function listUsers($paginateResult = false)
  {
    if ($paginateResult) {
      return $this->modelClass::paginate(10);
    }

    return $this->modelClass::all();
  }

  public function findSingleUser($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function store(StoreUsersPostRequest $request)
  {
    return $this->modelClass::create($request->all());
  }

  public function edit($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function persistUpdate(StoreUsersPostRequest $request, $id)
  {
    $validatedData = $request->validated();

    if ($request->filled('electronic_signature')) {
      $validatedData['electronic_signature'] = Hash::make($request->electronic_signature);
    } else {
      unset($validatedData['electronic_signature']);
    }

    if ($request->filled('password')) {
      $validatedData['password'] = Hash::make($request->password);
    } else {
      unset($validatedData['password']);
    }

    return $this->modelClass::findOrFail($id)->update($validatedData);
  }

  public function destroy($id)
  {
    $user = $this->modelClass::findOrFail($id);

    return $user->delete();
  }

  public function getAllUsersForSelect(): array
  {
    $baseArray = $this->modelClass::all();
    $users = array();

    foreach ($baseArray as $value) {
      $users[$value->id] = $value->posto_gradu . $value->nome_guerra;
    }

    return $users;
  }

  public function show($id)
  {
    return $this->modelClass::findOrFail($id);
  }
}
