@php
  $editObjectInstance = isset($featureInstance) ? $featureInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
  <div class="row">
    <div class="col-md-4">
      <label for="name" class="form-label label">Nome do Departamento</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-building"></i>
        </span>
        <input type="text" class="form-control" id="name" name="name"
          value="{{ old('name', $editObjectInstance->name ?? '') }}" required placeholder="Nome do Departamento" />
      </div>
    </div>
    <div class="col-md-8">
      <label for="comments" class="form-label label">Comentários</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-chat-text"></i>
        </span>
        <textarea class="form-control" id="comments" name="comments" placeholder="Comentários">{{ old('comments', $editObjectInstance->comments ?? '') }}</textarea>
      </div>
    </div>
  </div><br />
</x-AppComponents::form-template>

@section('styles')
  <style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }

    .form-checkbox:checked {
      background-color: #4a5568;
      /* Cor de tema escuro */
      border-color: #4a5568;
      /* Cor de tema escuro */
    }

    .form-checkbox {
      background-color: #2d3748;
      /* Cor de tema escuro */
      border-color: #2d3748;
      /* Cor de tema escuro */
    }
  </style>
@endsection
