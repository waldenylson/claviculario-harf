{{ $editObjectInstance = isset($featureInstance) ? $featureInstance : null }}

{{ isset($editObjectInstance) ? dd($editObjectInstance) : '' }}

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
  <div class="row">
    <div class="col-md-2">
      {{-- <label for="military" class="form-label label">Militar</label> --}}
      <div class="flex items-center">
        <input type="checkbox" id="military" name="military" value=""
          class="form-checkbox h-5 w-5 text-gray-700 dark:text-gray-300
           dark:bg-gray-800 dark:border-gray-600 focus:ring-0 focus:ring-offset-0"
          {{ old('military', $editObjectInstance->military ?? false) ? 'checked' : '' }} />
        <label for="military" class=" form-label label">Militar</label>
      </div>
    </div>
  </div><br />
  <div class="row">
    <div class="col-md-3">
      <label for="departament_id" class="form-label label">Departamento</label>
      <select class="form-control" id="departament_id" name="departament_id" required>
        <option value="">Selecione...</option>
        <option value="0">Sem Departamento</option>
        @foreach ($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4">      
      <label for="name" class="form-label label">Nome Completo</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-person-circle"></i>
        </span>
        <input type="text" class="form-control" id="name" name="name"
          value="{{ old('name', $editObjectInstance->name ?? '') }}" required placeholder="Fulano de tal" />
      </div>
    </div>
    <div class="col-md-4">
      <label for="email" class="form-label label">E-mail</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
  </div><br />
  <div class="row">
    <div class="col-md-3">
      <label for="phone" class="form-label label">Telefone</label>
      <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="col-md-2">
      <label for="extension" class="form-label label">Ramal</label>
      <input type="text" class="form-control" id="extension" name="extension">
    </div>

    <div class="col-md-3">
      <label for="electronic_signature" class="form-label label">Assinatura Eletrônica</label>
      <input type="text" class="form-control" id="electronic_signature" name="electronic_signature" required>
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
