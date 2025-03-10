<?php

namespace App\Http\Repositories\KeyMovement;

use App\Http\Requests\StoreKeyMovementPostRequest;
use App\Models\KeyMovement;

class KeyMovementRepository implements KeyMovementRepositoryContract
{
  protected string $modelClass = KeyMovement::class;

  public function listMovements($paginateResult = true)
  {
    if ($paginateResult) {
      return $this->modelClass::with(['key', 'harfStaff', 'user'])->paginate(10);
    }

    return $this->modelClass::with(['key', 'harfStaff', 'user'])->get();
  }

  public function findSingleMovement($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function store(StoreKeyMovementPostRequest $request)
  {
    return $this->modelClass::create($request->all());
  }

  public function edit($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function persistUpdate(StoreKeyMovementPostRequest $request, $id)
  {
    return $this->modelClass::findOrFail($id)->update($request->all());
  }

  public function destroy($id)
  {
    $movement = $this->modelClass::findOrFail($id);
    return $movement->delete();
  }
}
