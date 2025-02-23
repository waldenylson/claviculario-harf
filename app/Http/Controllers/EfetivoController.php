<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Users\EfetivoRepository;
use App\Http\Requests\StoreEfetivoPostRequest;
use Illuminate\Auth\Events\Registered;

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
        $usuarios = $this->efetivoRepository->listUsers();

        return view('users.index')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return redirect()->back()->with('error', 'Erro ao Tentar Inserir o Registro!');

        return view('users.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEfetivoPostRequest $request)
    {
        $this->checkEmailFAB($request);

        $result = $this->efetivoRepository->store($request);

        if ($result) {
            event(new Registered($result));

            return redirect()->back()->with('message', 'Registro Inserido com Sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao Tentar Inserir o Registro!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->efetivoRepository->edit($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEfetivoPostRequest $request, $id)
    {
        $this->checkEmailFAB($request);

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

    private function checkEmailFAB($request)
    {
        $dominio = explode("@", $request['email']);

        if ($dominio[1] !== "fab.mil.br") {
            return redirect()->back()->withErrors("E-Mail FAB Obrigatório!")->withInput();
        }
    }
}
