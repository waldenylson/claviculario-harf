<?php

namespace App\Http\Repositories\Key;

use App\Models\Key;
use App\Http\Requests\StoreKeyPostRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Http\Repositories\Keys\KeyRepositoryContract;

class KeyRepository implements KeyRepositoryContract
{
  protected string $modelClass = Key::class;

  public function index()
  {
    return $this->modelClass::all();
  }

  public function create()
  {
    // Return a new instance of the model
    return new $this->modelClass;
  }

  public function show($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function edit($id)
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

  public function listKeys($paginateResult = true)
  {
    if ($paginateResult) {
      return $this->modelClass::with('department')->paginate(10);
    }

    return $this->modelClass::with('department')->get();
  }

  public function store(StoreKeyPostRequest $request)
  {
    return $this->modelClass::create($request->all());
  }

  public function destroy(int $id)
  {
    return $this->modelClass::findOrFail($id)->delete();
  }
}
