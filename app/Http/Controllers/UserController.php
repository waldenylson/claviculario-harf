<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Users\UserRepository;
use App\Http\Requests\StoreUsersPostRequest;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    private UserRepository $usersRepository;

    public function __construct(UserRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = $this->usersRepository->listUsers();

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
    public function store(StoreUsersPostRequest $request)
    {

        $dominio = explode("@", $request['email']);

        if ($dominio[1] !== "fab.mil.br") {
            return redirect()->back()->withErrors("E-Mail FAB Obrigatório!")->withInput();
        }

        $result = $this->usersRepository->store($request);

        // dd($result);

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
        $user = $this->usersRepository->edit($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUsersPostRequest $request, $id)
    {
        $result = $this->usersRepository->persistUpdate($request, $id);

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
        $result = $this->usersRepository->destroy($id);

        if ($result) {
            return redirect()->back()->with('message', 'Registro Removido com Sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao Tentar Remover o Registro!');
    }
}
