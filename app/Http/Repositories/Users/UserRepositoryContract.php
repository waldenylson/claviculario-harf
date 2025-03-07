<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;

interface UserRepositoryContract
{
  public function listUsers($paginateResult = false);
  public function findSingleUser($id);
  public function show(int $id);
  public function store(StoreUsersPostRequest $request);
  public function edit(int $id);
  public function persistUpdate(StoreUsersPostRequest $request, int $id);
  public function destroy(int $id);
  public function getAllUsersForSelect();
}
