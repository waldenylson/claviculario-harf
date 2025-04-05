@php
  $editObjectInstance = isset($featureInstance) ? $featureInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
  <input type="hidden" name="electronic_signature" id="electronic_signature">
  <div class="row">
    <fieldset class="custom-groupbox" style="margin-bottom: 10px; margin-left: 15px; width: 97.3%;">
      <legend style="width: 130px">&nbsp;&nbsp;Efetivo HARF</legend>
      <div class="col-md-6">
        <select class="form-control" id="efetivo_id" name="efetivo_id" required>
          <option value="">Selecione...</option>
          @foreach ($staff as $efetivo)
            <option value="{{ $efetivo->id }}" {{ old('efetivo_id') == $efetivo->id ? 'selected' : '' }}>
              {{ $efetivo->name }}
            </option>
          @endforeach
        </select>
      </div>
    </fieldset>
  </div><br />
  <div id="pagination-container">
    @foreach ($keys->chunk(120) as $pageIndex => $pageChunk)
      <div class="page" style="display: {{ $pageIndex === 0 ? 'block' : 'none' }};">
        <div class="col-md-12">
          <div class="row">
            @foreach ($pageChunk->chunk(15) as $index => $chunk)
              @php
                $start = $pageIndex * 120 + $index * 15 + 1;
                $end = min($pageIndex * 120 + ($index + 1) * 15, $keys->count());
              @endphp
              <div class="col-md-3" style="margin-bottom: 20px;">
                <fieldset class="custom-groupbox">
                  <legend style="width: 190px">&nbsp;&nbsp;Chaves de {{ $start }} - {{ $end }}</legend>
                  <div class="row">
                    @foreach ($chunk->chunk(5) as $subChunk)
                      <div class="col-md-4">
                        @foreach ($subChunk as $key)
                          @php
                            $isCheckedOut = $key->is_checked_out; // Supondo que você tenha essa informação
                          @endphp
                          <div class="form-check" style="margin-bottom: 10px;">
                            <input type="checkbox" name="keys[]" value="{{ $key->id }}"
                              id="key-{{ $key->id }}" {{-- Adiciona um ID único para o checkbox --}}
                              class="form-checkbox h-5 w-5 text-gray-700 dark:text-gray-300
                                 dark:bg-gray-800 dark:border-gray-600 focus:ring-0 focus:ring-offset-0"
                              style="margin-left: -20px; cursor: {{ $isCheckedOut ? 'not-allowed' : 'pointer' }};"
                              title="{{ $isCheckedOut ? 'Chave já retirada! Não é possível selecionar.' : '' }}"
                              {{ $isCheckedOut ? 'disabled' : '' }}
                              {{ in_array($key->id, old('keys', [])) ? 'checked' : '' }} />
                            <label for="key-{{ $key->id }}" class="form-label label"
                              style="cursor: {{ $isCheckedOut ? 'not-allowed' : 'pointer' }};
                                     {{ $isCheckedOut ? 'color: red;' : '' }}"
                              title="{{ $isCheckedOut ? 'Chave já retirada! Não é possível selecionar.' : '' }}">
                              {{ $key->number }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </fieldset>
              </div>
              @if (($index + 1) % 4 == 0)
          </div>
          <div class="row">
    @endif
    @endforeach
  </div>
  </div><br />
  </div>
  @endforeach
  </div>

  <div class="pagination-controls">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <button type="button" class="page-link" onclick="firstPage()" aria-label="First">
            <span aria-hidden="true">&laquo;&laquo;&nbsp;Primeira</span>
          </button>
        </li>
        <li class="page-item">
          <button type="button" class="page-link" onclick="prevPage()" aria-label="Previous">
            <span aria-hidden="true">&laquo;&nbsp;Anterior</span>
          </button>
        </li>
        <li class="page-item">
          <button type="button" class="page-link" onclick="nextPage()" aria-label="Next">
            <span aria-hidden="true">&nbsp;Próxima&nbsp;&raquo;</span>
          </button>
        </li>
        <li class="page-item">
          <button type="button" class="page-link" onclick="lastPage()" aria-label="Last">
            <span aria-hidden="true">&nbsp;Última&nbsp;&raquo;&raquo;</span>
          </button>
        </li>
      </ul>
    </nav>
  </div>
</x-AppComponents::form-template>

<style>
  fieldset.custom-groupbox {
    position: relative;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 1.5rem 1rem 1rem 1rem;
    /* aumento no padding superior para dar espaço ao legend */
  }

  fieldset.custom-groupbox legend {
    position: absolute;
    top: -0.7em;
    /* posiciona o legend acima da borda */
    left: 1rem;
    --tw-bg-opacity: 1;
    background-color: rgb(107 114 128 / var(--tw-bg-opacity));
    padding: 0 0.5rem;
    font-size: 1rem;
    font-weight: 600;
  }
</style>

<script>
  let currentPage = 0;
  const pages = document.querySelectorAll('.page');

  function showPage(pageIndex) {
    pages.forEach((page, index) => {
      page.style.display = index === pageIndex ? 'block' : 'none';
    });
  }

  function firstPage() {
    currentPage = 0;
    showPage(currentPage);
  }

  function prevPage() {
    if (currentPage > 0) {
      currentPage--;
      showPage(currentPage);
    }
  }

  function nextPage() {
    if (currentPage < pages.length - 1) {
      currentPage++;
      showPage(currentPage);
    }
  }

  function lastPage() {
    currentPage = pages.length - 1;
    showPage(currentPage);
  }

  document.getElementById('btn-submit').addEventListener('click', function(event) {
    event.preventDefault();
    submitFormWithSignature();
  });

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
          document.getElementById('key-movement-form').submit();
        }
      }
    });

    // Adiciona um evento de input para permitir apenas números
    Swal.getInput().addEventListener('input', function(event) {
      this.value = this.value.replace(/[^0-9]/g, '');
    });
  }
</script>
