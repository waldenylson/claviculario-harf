{{-- @php dd($efetivo) @endphp --}}

@extends('layouts.app')
@section('content_body')

  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Listagem de Efetivos</h1>
    </div>
    <div class="card-body bg-gray-500">
      <div class="form-group well">
        <div class="container py-12">
          <table class="table table-hover table-striped align-middle" style="width: 70vw;margin-left: -100px;">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Nome Completo</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ramal</th>
                <th>Seção</th>
                <th>Militar</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($efetivo as $staff)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $staff->name }}</td>
                  <td>{{ $staff->email }}</td>
                  <td>{{ $staff->phone }}</td>
                  <td>{{ $staff->extension }}</td>
                  <td>{{ $staff->department->name ?? 'Sem Departamento' }}</td>
                  <td>{{ $staff->military ? 'Sim' : 'Não' }}</td>
                  <td class="text-center">
                    <a href="{{ route('efetivo.edit', $staff->id) }}" class="btn btn-sm btn-warning mx-1">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger mx-1 btn-delete"
                      data-link="{{ route('efetivo.destroy', $staff->id) }}" data-id="{{ $staff->id }}"
                      data-name="{{ $staff->name }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted">Nenhum efetivo encontrado.</td>
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
          const staffId = button.getAttribute('data-id');
          const staffName = button.getAttribute('data-name');
          const route = button.getAttribute('data-link');

          Swal.fire({
            title: 'Confirma a exclusão?',
            text: `Deseja realmente excluir do efetivo "${staffName}"? Esta ação não pode ser desfeita!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              formDelete.setAttribute('action', route);
              formDelete.submit();
            }
          });
        });
      });
    });
  </script>

  <style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }
  </style>
@stop
