{{-- @php dd($staff) @endphp --}}

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
                    <button class="btn btn-sm btn-danger mx-1 btn-delete" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Excluir" data-link="{{ route('key_movements.destroy', $movement->id) }}"
                      data-id="{{ $movement->id }}" data-name="{{ $movement->key->number }}">
                      <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-sm btn-success mx-1 btn-return" data-bs-toggle="tooltip"
                      data-bs-placement="top" title="Devolver"
                      data-link="{{ route('key_movements.returnKey', $movement->id) }}" data-id="{{ $movement->id }}"
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
            <input type="hidden" name="electronic_signature" id="electronic_signature">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function submitFormWithSignature() {
      Swal.fire({
        title: 'Digite sua assinatura eletrônica!',
        input: 'password',
        inputLabel: 'Senha/Assinatura Eletrônica',
        inputPlaceholder: '********',
        inputAttributes: {
          autocapitalize: 'off',
          autocorrect: 'off',
          style: 'background-color: #333; color: #fff;',
          inputmode: 'numeric'
        },
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        showLoaderOnConfirm: false,
        cancelButtonText: 'Cancelar',
        buttonsStyling: true,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-secondary'
        },
        preConfirm: (signature) => {
          if (!signature) {
            Swal.showValidationMessage('Assinatura eletrônica é Obrigatória!')
          } else {
            document.getElementById('electronic_signature').value = signature;
            document.getElementById('form-return').submit();
          }
        }
      });

      // Adiciona um evento de input para permitir apenas números
      Swal.getInput().addEventListener('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
      });
    }
    
    document.addEventListener('DOMContentLoaded', () => {
      const returnButtons = document.querySelectorAll('.btn-return');
      const formReturn = document.getElementById('form-return');

      // Obter os dados do $staff do Blade e passar para o JavaScript
      const staffData = @json($staff->map(fn($staff) => ['id' => $staff->id, 'name' => $staff->name]));


      returnButtons.forEach(button => {
        button.addEventListener('click', () => {
          const route = button.getAttribute('data-link');

          Swal.fire({
            title: 'Confirma a devolução?',
            html: `
              <p>Militar/Civil devolvendo a chave:</p>
              <input type="text" id="efetivo_id" class="swal2-input" placeholder="Nome do responsável" />
              <ul id="autocomplete-list" style="list-style: none; padding: 0; margin: 0;"></ul>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, devolver!',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
              const responsibleName = document.getElementById('efetivo_id').value;
              const selectedStaff = staffData.find(staff => staff.name === responsibleName);

              if (!responsibleName || !selectedStaff) {
                Swal.showValidationMessage('O nome do responsável é obrigatório e deve ser válido!');
              }

              return selectedStaff.id; // Retorna o ID do staff selecionado
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const staffId = result.value; // ID do staff selecionado
              console.log('ID do responsável:', staffId);

              // Adicionar o ID do responsável ao formulário
              const inputResponsibleId = document.createElement('input');
              inputResponsibleId.type = 'hidden';
              inputResponsibleId.name = 'efetivo_id';
              inputResponsibleId.value = staffId;
              formReturn.appendChild(inputResponsibleId);

              formReturn.setAttribute('action', route);
              submitFormWithSignature();
            }
          });

          // Implementar o autocompletar
          const input = document.getElementById('efetivo_id');
          const autocompleteList = document.getElementById('autocomplete-list');

          input.addEventListener('input', function () {
            const value = this.value.toLowerCase();
            autocompleteList.innerHTML = ''; // Limpar sugestões anteriores

            if (value) {
              const suggestions = staffData.filter(staff => staff.name.toLowerCase().includes(value));

              suggestions.forEach(staff => {
                const listItem = document.createElement('li');
                listItem.textContent = staff.name;

                // Aplicar os estilos definidos no CSS
                listItem.classList.add('autocomplete-item');

                listItem.addEventListener('click', () => {
                  input.value = staff.name; // Preencher o campo com o nome selecionado
                  autocompleteList.innerHTML = ''; // Limpar a lista de sugestões
                });

                autocompleteList.appendChild(listItem);
              });
            }
          });
        });
      });

      // Inicializar tooltips do Bootstrap
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })

      const deleteButtons = document.querySelectorAll('.btn-delete');
      const formDelete = document.getElementById('form-delete');

      deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
          const route = button.getAttribute('data-link');
          const keyName = button.getAttribute('data-name');

          Swal.fire({
            title: 'Tem certeza?',
            text: `Deseja excluir a chave ${keyName}? Esta ação não pode ser desfeita.`,
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

    /* Estilo para o campo de entrada */
    #efetivo_id {
      background-color: #333; /* Fundo escuro */
      color: #fff; /* Texto branco */
      border: 1px solid #555; /* Borda mais suave */
      border-radius: 2px; /* Bordas arredondadas */
      padding: 10px; /* Espaçamento interno */
      font-size: 14px; /* Tamanho da fonte */
      width: 80%; /* Largura total */
    }

    /* Estilo para a lista de autocompletar */
    #autocomplete-list {
      background-color: #444; /* Fundo escuro */
      color: #fff; /* Texto branco */
      border: 1px solid #555; /* Borda mais suave */
      border-radius: 5px; /* Bordas arredondadas */
      max-height: 150px; /* Altura máxima */
      overflow-y: auto; /* Rolagem vertical */
      margin-top: 5px; /* Espaçamento acima */
      padding: 5px; /* Espaçamento interno */
    }

    /* Estilo para os itens da lista */
    #autocomplete-list li {
      padding: 8px; /* Espaçamento interno */
      cursor: pointer; /* Cursor de ponteiro */
      border-radius: 3px; /* Bordas arredondadas */
    }

    /* Estilo para o item ao passar o mouse */
    #autocomplete-list li:hover {
      background-color: #555; /* Fundo mais claro ao passar o mouse */
    }

    /* Estilo para os itens reutilizáveis */
    .autocomplete-item {
      padding: 8px; /* Espaçamento interno */
      cursor: pointer; /* Cursor de ponteiro */
      border-radius: 3px; /* Bordas arredondadas */
      background-color: #444; /* Fundo escuro */
      color: #fff; /* Texto branco */
      border: 1px solid #555; /* Borda mais suave */
      margin-top: 2px; /* Espaçamento entre itens */
    }

    /* Estilo para o item ao passar o mouse */
    .autocomplete-item:hover {
      background-color: #555; /* Fundo mais claro ao passar o mouse */
    }
  </style>
@endsection
