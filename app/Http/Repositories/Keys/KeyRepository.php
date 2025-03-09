<?php

namespace App\Http\Repositories\Keys;

use App\Models\Key;
use App\Http\Requests\StoreKeyPostRequest;
use App\Http\Repositories\Keys\KeyRepositoryContract;

class KeyRepository implements KeyRepositoryContract
{
  protected string $modelClass = Key::class;

  public function listKeys($paginateResult = false)
  {
    if ($paginateResult) {
      return $this->modelClass::with('department')->paginate(10);
    }

    return $this->modelClass::with('department')->get();
  }

  public function findSingleKey(int $id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function edit(int $id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function persistUpdate(StoreKeyPostRequest $request, $id)
  {
    $key = $this->modelClass::findOrFail($id);
    $key->update($request->all());
    return $key;
  }

  public function getAllKeysForSelect()
  {
    return $this->modelClass::pluck('name', 'id');
  }

  public function store(StoreKeyPostRequest $request)
  {
    return $this->modelClass::create($request->all());
  }

  public function destroy(int $id)
  {
    return $this->modelClass::findOrFail($id)->delete();
  }

  public function index() {}
  public function create() {}
  public function show(int $id) {}
}
