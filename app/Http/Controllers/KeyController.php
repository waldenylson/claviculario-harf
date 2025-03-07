<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Http\Requests\StoreKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Http\Repositories\Key\KeyRepository;

class KeyController extends Controller
{
  protected $repository;

  public function __construct(KeyRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index()
    {
    $keys = $this->repository->listKeys();
    return view('keys.index', compact('keys'));
    }

  public function create()
    {
    $departments = Department::all();
    return view('keys.create', compact('departments'));
    }

  public function store(StoreKeyRequest $request)
    {
    $this->repository->store($request);
    return redirect()->route('keys.index')->with('success', 'Chave criada com sucesso.');
    }

  public function show(Key $key)
    {
        //
    }

  public function edit(Key $key)
    {
    $departments = Department::all();
    return view('keys.edit', compact('key', 'departments'));
    }

  public function update(UpdateKeyRequest $request, Key $key)
    {
    $this->repository->update($request, $key);
    return redirect()->route('keys.index')->with('success', 'Chave atualizada com sucesso.');
    }

  public function destroy(Key $key)
    {
    $this->repository->destroy($key);
    return redirect()->route('keys.index')->with('success', 'Chave excluída com sucesso.');
    }
}
