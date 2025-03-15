@php
  $editObjectInstance = isset($editObjectInstance) ? $editObjectInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
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
                          <div class="form-check" style="margin-bottom: 10px;">
                            <input type="checkbox" name="keys[]" value="{{ $key->id }}"
                              class="form-checkbox h-5 w-5 text-gray-700 dark:text-gray-300
                               dark:bg-gray-800 dark:border-gray-600 focus:ring-0 focus:ring-offset-0"
                              style="margin-left: -20px;cursor: pointer;" />
                            <label for="keys" class="form-label label">{{ $key->number }}</label>
                          </div>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </fieldset>
                @if (($index + 1) % 4 == 0)
              </div>
              <div class="row">
            @endif
          </div>
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
</script>
