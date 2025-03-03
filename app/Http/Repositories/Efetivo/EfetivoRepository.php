<?php

namespace App\Http\Repositories\Efetivo;

use App\Http\Requests\StoreEfetivoPostRequest;
use App\Models\HarfStaff;
use Illuminate\Support\Facades\Hash;

class EfetivoRepository implements EfetivoRepositoryContract
{
  protected string $modelClass = HarfStaff::class;

  public function listStaff(): \Illuminate\Database\Eloquent\Collection
  {
    return $this->modelClass::all();
  }

  public function findSingleStaff($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function store(StoreEfetivoPostRequest $request)
  {
    dd($request);

    return $this->modelClass::create($request->all());
  }

  public function edit($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function persistUpdate(StoreEfetivoPostRequest $request, $id)
  {
    $validatedData = $request->validated();

    if ($request->filled('electronic_signature')) {
      $validatedData['electronic_signature'] = Hash::make($request->electronic_signature);
    } else {
      unset($validatedData['electronic_signature']);
    }

    return $this->modelClass::findOrFail($id)->update($validatedData);
  }

  public function destroy($id)
  {
    $user = $this->modelClass::findOrFail($id);

    return $user->delete();
  }

  public function index()
  {
    // Implement the index method
  }

  public function create()
  {
    // Implement the create method
  }

  public function show($id)
  {
    // Implement the show method
  }

  public function getAllUsersForSelect()
  {
    // Implement the getAllUsersForSelect method
  }
}
