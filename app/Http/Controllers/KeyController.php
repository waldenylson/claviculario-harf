<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Departments\DepartmentsRepository;
use App\Http\Repositories\Keys\KeyRepository;
use App\Http\Requests\StoreKeyPostRequest;

class KeyController extends Controller
{
  private KeyRepository $keysRepository;
  private DepartmentsRepository $departmentsRepository;

  public function __construct(KeyRepository $keysRepository, DepartmentsRepository $departmentsRepository)
  {
    $this->keysRepository = $keysRepository;
    $this->departmentsRepository = $departmentsRepository;
  }

  public function index()
  {
    $keys = $this->keysRepository->listKeys(true);

    return view('keys.index', compact('keys'));
  }

  public function create()
  {
    $departments = $this->departmentsRepository->listDepartments();

    return view('keys.new', compact('departments'));
  }

  public function store(StoreKeyPostRequest $request)
  {
    $result = $this->keysRepository->store($request);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Inserido com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Inserir o Registro!');
  }

  public function show(int $id) {}

  public function edit(int $id)
  {
    $key = $this->keysRepository->edit($id);

    $departments = $this->departmentsRepository->listDepartments();

    $department = $this->departmentsRepository->findSingleDepartment($key->department_id);

    return view('keys.edit', compact('key', 'departments', 'department'));
  }

  public function update(StoreKeyPostRequest $request, int $id)
  {
    $result = $this->keysRepository->persistUpdate($request, $id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Alterado com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Alterar o Registro!');
  }

  public function destroy(int $id)
  {
    $result = $this->keysRepository->destroy($id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Removido com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Remover o Registro!');
  }
}
