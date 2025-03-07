<?php

namespace App\Http\Repositories\Keys;

use App\Http\Requests\StoreKeyPostRequest;
use App\Models\Key;

interface KeyRepositoryContract
{
  public function index();
  public function create();
  public function show(int $id);
  public function store(StoreKeyPostRequest $request);
  public function edit(int $id);
  public function persistUpdate(StoreKeyPostRequest $request, int $id);
  public function destroy(int $id);
  public function getAllKeysForSelect();
}
