<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Users\UserRepository;
use App\Http\Requests\StoreUsersPostRequest;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.new', [
            'user' => 'teste',
        ]);
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

//        dd($request);

        $result = $this->usersRepository->store($request);

        if ($result)
        {
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
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUsersPostRequest $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
