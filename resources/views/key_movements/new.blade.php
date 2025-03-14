@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Nova Movimentação de Chave</h1>
    <form action="{{ route('key_movements.store') }}" method="POST">
      @csrf
      <!-- ...existing code... -->
      <div class="form-group">
        <label for="keys">Chaves</label>
        <div class="row">
          @foreach ($keys->chunk(60) as $pageIndex => $pageChunk)
            <div class="col-md-12">
              <div class="row">
                @foreach ($pageChunk->chunk(10) as $index => $chunk)
                  <div class="col-md-4" style="margin 1px solid yellow;">
                    <fieldset>
                      <legend>Chaves de {{ $pageIndex * 60 + $index * 10 + 1 }} até
                        {{ $pageIndex * 60 + ($index + 1) * 10 }}</legend>
                      <div class="row">
                        @foreach ($chunk->chunk(5) as $subChunk)
                          <div id="teste" 
                            class="col-md-6" 
                            style="margin-bottom: 2px; 
                              border: 1px solid green;
                              padding: 5px;" 
                            >
                            @foreach ($subChunk as $key)
                              <div class="form-check" 
                                style="margin-bottom: 5px;
                                  margin-top: 5px;
                                  margin-left: 5px; 
                                  border: 1px solid red;
                                  width: 50px;"
                              >
                                <input type="checkbox" name="keys[]" value="{{ $key->id }}" 
                                  class="form-check-input" style="margin-left: -20px;">
                                <label class="form-check-label">{{ $key->number }}</label>
                              </div>
                            @endforeach
                          </div>
                        @endforeach
                      </div>
                    </fieldset>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </form>
    <div class="pagination">
      {{ $keys->links() }}
    </div>
  </div>
@endsection
