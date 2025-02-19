{{-- @php dd($usuarios) @endphp --}}

@extends('layouts.app')
@section('content_body')


    <div class="card  direct-chat" style="width: 90%">
        <div class="card-header">
            <h1 class="card-title">Listagem de Usuários</h1>

        </div>
        <div class="card-body bg-gray-500">
            <div class="form-group well">
                <div class="container py-12">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Post/Grad Esp</th>
                                <th>Nome Completo</th>
                                <th>Nome Guerra</th>
                                <th>E-mail</th>
                                <th>Unidade/Seção</th>
                                <th>Telefone</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usuario->military_rank }}</td>
                                    <td>{{ $usuario->full_name }}</td>
                                    <td>{{ $usuario->service_name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->military_unit }}</td>
                                    <td>{{ $usuario->phone }}</td>
                                    <td class="text-center">
                                        {{-- {{ route('usuarios.edit', $usuario->id) }} --}}
                                        <a href="#" class="btn btn-sm btn-warning mx-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger mx-1 btn-delete"
                                            data-id="{{ $usuario->id }}"
                                            data-name="{{ $usuario->full_name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Formulário de Exclusão -->
                    <form id="form-delete" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            const formDelete = document.getElementById('form-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.getAttribute('data-id');
                    const userName = button.getAttribute('data-name');

                    Swal.fire({
                        title: 'Confirma a exclusão?',
                        text: `Deseja realmente excluir o usuário "${userName}"? Esta ação não pode ser desfeita!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Define a ação do formulário e o envia
                            formDelete.action = `/usuarios/${userId}`;
                            formDelete.submit();
                        }
                    });
                });
            });
        });
    </script>


    <!-- /.card-body -->
    <div class="card-footer">

    </div>
    <!-- /.card-footer-->

@stop

