<?php

namespace App\Http\Repositories\KeyMovement;

use App\Http\Requests\StoreKeyMovementPostRequest;
use App\Models\KeyMovement;

class KeyMovementRepository implements KeyMovementRepositoryContract
{
  protected $modelClass = KeyMovement::class;

  public function listMovements($paginateResult = true, $paginateNumber = 10)
  {
    if ($paginateResult) {
      return $this->modelClass::with(['key', 'harfStaff', 'user'])->paginate($paginateNumber ?? 10);
    }

    return $this->modelClass::with(['key', 'harfStaff', 'user'])->get();
  }

  public function findSingleMovement($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function store(StoreKeyMovementPostRequest $request)
  {
    return KeyMovement::create([
      'key_id' => $request->key_id,
      'harf_staff_id' => $request->harf_staff_id,
      'user_id' => $request->user_id,
      'movement_type' => $request->movement_type,
      'out' => $request->out,
      'comments' => $request->comments,
      'movement' => $request->movement, // Adicione este campo
    ]);
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

  /**
   * Find an active key movement by key ID and staff ID.
   *
   * @param int $keyId
   * @param int $staffId
   * @return KeyMovement|null
   */
  public function findActiveMovementByKeyAndStaff(int $keyId, int $staffId): ?KeyMovement
  {
    return KeyMovement::where('key_id', $keyId)
      ->where('harf_staff_id', $staffId)
      ->whereNull('return')
      ->first();
  }
}
