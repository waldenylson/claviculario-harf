{{-- @php dd($departments) @endphp --}}

@extends('layouts.app')
@section('content_body')

  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Listagem de Seções</h1>
    </div>
    <div class="card-body bg-gray-500">
      <div class="form-group well">
        <div class="container py-12">
          <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Comentários</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($departments as $department)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $department->name }}</td>
                  <td>{{ $department->comments }}</td>
                  <td class="text-center">
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger mx-1 btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"
                      data-link="{{ route('departments.destroy', $department->id) }}" data-id="{{ $department->id }}"
                      data-name="{{ $department->name }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">Nenhum Seção encontrada.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <!-- Links de Paginação -->
          <div class="d-flex justify-content-center">
            {{ $departments->links('vendor.pagination.bootstrap-5') }}
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
          const departmentId = button.getAttribute('data-id');
          const departmentName = button.getAttribute('data-name');
          const route = button.getAttribute('data-link');

          Swal.fire({
            title: 'Confirma a exclusão?',
            text: `Deseja realmente excluir a seção "${departmentName}"? Esta ação não pode ser desfeita!`,
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

      // Inicializar tooltips do Bootstrap
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    });
  </script>

  <style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }
  </style>
@stop
