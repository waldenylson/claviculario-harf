{{-- @php dd($efetivo) @endphp --}}

@extends('layouts.app')
@section('content_body')
  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Chaves Movimentadas sem Devolução</h1>
    </div>
    <div class="card-body bg-gray-500">
      <div class="form-group well">
        <div class="container py-12">
          <table class="table table-hover table-striped align-middle" style="width: 70vw;margin-left: -100px;">
            <thead class="table-dark">
              <tr>
                <th>Chave</th>
                <th>Efetivo HARF</th>
                <th>Data/Hora</th>
                <th>Permanência</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($movements as $movement)
                <tr>
                  <td>{{ str_pad($movement->key->number, 3, '0', STR_PAD_LEFT) }}</td>
                  <td>{{ $movement->harfStaff->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($movement->out)->format('d/m/Y H:i:s') }}</td>
                  <td>{{ $movement->user->military_rank . ' ' . $movement->user->service_name }}</td>
                  <td class="text-center">
                    {{-- <a href="{{ route('key_movements.edit', $movement->id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                      <i class="fa fa-edit"></i>
                    </a> --}}
                    <button class="btn btn-sm btn-danger mx-1 btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"
                      data-link="{{ route('key_movements.destroy', $movement->id) }}" data-id="{{ $movement->id }}"
                      data-name="{{ $movement->key->number }}">
                      <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-sm btn-success mx-1 btn-return" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver"
                      data-link="{{ route('key_movements.return', $movement->id) }}" data-id="{{ $movement->id }}"
                      data-name="{{ $movement->key->number }}">
                      <i class="fa fa-key"></i> <!-- Ícone de chave para devolução -->
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
          <!-- Links de Paginação -->
          <div class="d-flex justify-content-center">
            {{ $movements->links('vendor.pagination.bootstrap-5') }}
          </div>
          <!-- Formulário de Exclusão -->
          <form id="form-delete" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
          </form>
          <!-- Formulário de Devolução -->
          <form id="form-return" method="POST" style="display: none;">
            @csrf
            @method('PATCH')
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const deleteButtons = document.querySelectorAll('.btn-delete');
      const returnButtons = document.querySelectorAll('.btn-return');
      const formDelete = document.getElementById('form-delete');
      const formReturn = document.getElementById('form-return');

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

      returnButtons.forEach(button => {
        button.addEventListener('click', () => {
          const staffId = button.getAttribute('data-id');
          const staffName = button.getAttribute('data-name');
          const route = button.getAttribute('data-link');

          Swal.fire({
            title: 'Confirma a devolução?',
            text: `Deseja realmente devolver a chave "${staffName}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, devolver!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              formReturn.setAttribute('action', route);
              formReturn.submit();
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
@endsection

