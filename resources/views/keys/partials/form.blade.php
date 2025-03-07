@php
  $editObjectInstance = isset($editObjectInstance) ? $editObjectInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
  <form action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    <div class="row">
      <div class="col-md-3">
        <label for="department_id" class="form-label label">Seção</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-diagram-3"></i>
          </span>
          <select class="form-control" id="department_id" name="department_id" required>
            <option>Selecione...</option>
            @foreach ($departments as $department)
              <option value="{{ $department->id }}"
                {{ old('department_id', $editObjectInstance->department_id ?? '') == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <label for="number" class="form-label label">Número</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-hash"></i>
          </span>
          <input type="number" class="form-control" id="number" name="number"
            value="{{ old('number', $editObjectInstance->number ?? '') }}" required placeholder="123" />
        </div>
      </div>
      <div class="col-md-2">
        <label for="internal_hallway" class="form-label label">Corredor Interno</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-building"></i>
          </span>
          <select class="form-control" id="internal_hallway" name="internal_hallway" required>
            <option value="1"
              {{ old('internal_hallway', $editObjectInstance->internal_hallway ?? '') == 1 ? 'selected' : '' }}>Sim
            </option>
            <option value="0"
              {{ old('internal_hallway', $editObjectInstance->internal_hallway ?? '') == 0 ? 'selected' : '' }}>Não
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <label for="eps" class="form-label label">EPS</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-shield"></i>
          </span>
          <select class="form-control" id="eps" name="eps" required>
            <option value="1" {{ old('eps', $editObjectInstance->eps ?? '') == 1 ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ old('eps', $editObjectInstance->eps ?? '') == 0 ? 'selected' : '' }}>Não</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <label for="epms" class="form-label label">EPMS</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-shield-fill"></i>
          </span>
          <select class="form-control" id="epms" name="epms" required>
            <option value="1" {{ old('epms', $editObjectInstance->epms ?? '') == 1 ? 'selected' : '' }}>Sim
            </option>
            <option value="0" {{ old('epms', $editObjectInstance->epms ?? '') == 0 ? 'selected' : '' }}>Não
            </option>
          </select>
        </div>
      </div>
    </div><br />
    <div class="row">
      <div class="col-md-12">
        <label for="comments" class="form-label label">Comentários</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-chat-left-text"></i>
          </span>
          <textarea class="form-control" id="comments" name="comments" rows="3">{{ old('comments', $editObjectInstance->comments ?? '') }}</textarea>
        </div>
      </div>
    </div><br />
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </form>
</x-AppComponents::form-template>

@section('styles')
  <style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }
  </style>
@endsection
