<?php

namespace App\Http\Repositories\KeyMovement;

use App\Http\Requests\StoreKeyMovementPostRequest;

interface KeyMovementRepositoryContract
{
  public function listMovements($paginateResult = true, $paginateNumber = 10);
  public function findSingleMovement($id);
  public function store(StoreKeyMovementPostRequest $request);
  public function edit($id);
  public function persistUpdate(StoreKeyMovementPostRequest $request, $id);
  public function destroy($id);
}
