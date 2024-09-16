@extends('layouts.app')

@section('content_body')

    <div class="card  direct-chat" style="width: 90%">
        <div class="card-header">
            <h1 class="card-title">Criar Novo Usuário do Sistema</h1>

        </div>
        <!-- /.card-header -->
        <div class="card-body bg-gray-500">
            <div class="container mx-auto py-12">
                <div class="w-4/5 mx-auto bg-gray-400 shadow-md rounded px-8 pt-6 pb-8 mb-4s">
                    <form>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Nome de Guerra com Posto/Graduação
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="2S Fulano">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                E-mail
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email" placeholder="email">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                                Celular
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="text" type="text" placeholder="Celular">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Senha
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="password" type="password" placeholder="Digite sua senha">
                        </div>
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>

@stop
