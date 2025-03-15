@php
  $editObjectInstance = isset($editObjectInstance) ? $editObjectInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">

  @foreach ($keys->chunk(60) as $pageIndex => $pageChunk)
    <div class="col-md-12">
      <div class="row">
        @foreach ($pageChunk->chunk(15) as $index => $chunk)
          @php
            $start = $pageIndex * 60 + $index * 15 + 1;
            $end = min($pageIndex * 60 + ($index + 1) * 15, $keys->count());
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
          </div>
          @if (($index + 1) % 4 == 0)
            </div><div class="row">
          @endif
        @endforeach
      </div>
    </div><br />
  @endforeach
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
