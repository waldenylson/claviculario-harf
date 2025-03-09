@extends('layouts.app')
@section('content_body')

  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Listagem de Chaves</h1>
    </div>
    <div class="card-body bg-gray-500">
      <div class="form-group well">
        <div class="container py-12">
          <table class="table table-hover table-striped align-middle" style="width: 70vw;margin-left: -100px;">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Departamento</th>
                <th>Número</th>
                <th>Corredor Interno</th>
                <th>EPS</th>
                <th>EPMS</th>
                <th>Comentários</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($keys as $key)
                <tr>
                  <td>{{ $keys->firstItem() + $loop->index }}</td>
                  <td>{{ $key->department->name ?? 'Sem Departamento' }}</td>
                  <td>{{ $key->number }}</td>
                  <td>{{ $key->internal_hallway ? 'Sim' : 'Não' }}</td>
                  <td>{{ $key->eps ? 'Sim' : 'Não' }}</td>
                  <td>{{ $key->epms ? 'Sim' : 'Não' }}</td>
                  <td>{{ $key->comments }}</td>
                  <td class="text-center">
                    <a href="{{ route('keys.edit', $key->id) }}" class="btn btn-sm btn-warning mx-1">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger mx-1 btn-delete"
                      data-link="{{ route('keys.destroy', $key->id) }}" data-id="{{ $key->id }}"
                      data-name="{{ $key->number }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted">Nenhuma chave encontrada.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <!-- Links de Paginação -->
          <div class="d-flex justify-content-center">
            {{ $keys->links('vendor.pagination.bootstrap-5') }}
          </div>
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
          const keyId = button.getAttribute('data-id');
          const keyNumber = button.getAttribute('data-name');
          const route = button.getAttribute('data-link');

          Swal.fire({
            title: 'Confirma a exclusão?',
            text: `Deseja realmente excluir a chave número "${keyNumber}"? Esta ação não pode ser desfeita!`,
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
