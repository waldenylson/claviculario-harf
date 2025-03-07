<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Efetivo\EfetivoRepository;
use App\Http\Requests\StoreEfetivoPostRequest;
use App\Models\Department;

class EfetivoController extends Controller
{
  private EfetivoRepository $efetivoRepository;

  public function __construct(EfetivoRepository $repository)
  {
    $this->efetivoRepository = $repository;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $efetivo = $this->efetivoRepository->listStaff();

    return view('efetivo.index')->with(compact('efetivo'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $departments = Department::all();

    return view('efetivo.new')->with(compact('departments'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreEfetivoPostRequest $request)
  {
    $result = $this->efetivoRepository->store($request);

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
  public function edit($id)
  {
    $staff = $this->efetivoRepository->edit($id);
    $departments = Department::all();

    return view('efetivo.edit')
      ->with(compact('departments'))
      ->with(compact('staff'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreEfetivoPostRequest $request, $id)
  {
    $result = $this->efetivoRepository->persistUpdate($request, $id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Alterado com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Alterar o Registro!');
  }

  /**
   * Remove um registro especifico do Banco.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $result = $this->efetivoRepository->destroy($id);

    if ($result) {
      return redirect()->back()->with('message', 'Registro Removido com Sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao Tentar Remover o Registro!');
  }
}
