<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Departments\DepartmentsRepository;
use App\Http\Repositories\Keys\KeyRepository;
use App\Http\Requests\StoreDepartmentPostRequest;

class DepartmentController extends Controller
{
  private DepartmentsRepository $departmentsRepository;
  private KeyRepository $keysRepository;

  public function __construct(DepartmentsRepository $repository, KeyRepository $keyRepository)
  {
    $this->departmentsRepository = $repository;
    $this->keysRepository = $keyRepository;  // Fix this line
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $departments = $this->departmentsRepository->listDepartments(true);

    return view('departments.index', compact('departments'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('departments.new');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreDepartmentPostRequest $request)
  {
    $result = $this->departmentsRepository->store($request);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Inserido com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Inserir o Registro!');
  }

  /**
   * Display the specified resource.
   */
  public function show(int $id) {}

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(int $id)
  {
    $department = $this->departmentsRepository->edit($id);

    return view('departments.edit')->with(compact('department'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreDepartmentPostRequest $request, int $id)
  {
    $result = $this->departmentsRepository->persistUpdate($request, $id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Alterado com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Alterar o Registro!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(int $id)
  {
    $department = $this->departmentsRepository->findSingleDepartment($id);

    // Verifica se o departamento tem efetivos/chaves relacionados
    if ($department->harfStaff()->count() > 0 || $department->keys()->count() > 0) {
      return redirect()->back()->with('error', 'Seção não pode ser excluída pois há Efetivos/Chaves relacionados!');
    }

    $result = $this->departmentsRepository->destroy($id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Removido com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Remover o Registro!');
  }
}
