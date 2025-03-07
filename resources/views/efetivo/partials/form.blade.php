@php
  $editObjectInstance = isset($featureInstance) ? $featureInstance : null;
@endphp

<x-AppComponents::form-template :featureInstance="$editObjectInstance">
  <div class="row">
    <div class="col-md-2">
      <div class="flex items-center">
        <input type="hidden" name="military" id="military" value="0">
        <input type="checkbox" id="military" name="military" value="1"
          class="form-checkbox h-5 w-5 text-gray-700 dark:text-gray-300
           dark:bg-gray-800 dark:border-gray-600 focus:ring-0 focus:ring-offset-0"
           {{ old('military', $editObjectInstance->military ?? '') ? 'checked' : '' }}
        />
        <label for="military" class="form-label label">Militar</label>
      </div>
    </div>
  </div><br />
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
      <label for="email" class="form-label label">E-Mail</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-envelope-at"></i>
        </span>
        <input type="email" class="form-control" id="email" name="email"
          value="{{ old('email', $editObjectInstance->email ?? '') }}" placeholder="email@exemplo.com" required>
      </div>
    </div>
  </div><br />
  <div class="row">
    <div class="col-md-3">
      <label for="phone" class="form-label label">Tel. Contato</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-telephone"></i>
        </span>
        <input type="text" class="form-control masked-cel-phone" id="phone" name="phone"
          value="{{ old('phone', $editObjectInstance->phone ?? '') }}" placeholder="(99) 99999-9999" required />
      </div>
    </div>
    <div class="col-md-2">
      <label for="extension" class="form-label label">Ramal</label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="fas fa-phone "></i>
        </span>
        <input type="text" class="form-control" id="extension" name="extension"
          value="{{ old('extension', $editObjectInstance->extension ?? '') }}" placeholder="9999" />
      </div>
    </div>
    <div class="col-md-4">
      <label for="electronic_signature" class="form-label label">Assinatura Eletrônica </label>
      <div class="input-group">
        <span class="input-group-text">
          <i class="bi bi-pen"></i>
        </span>
        <input type="password" class="form-control" id="electronic_signature" name="electronic_signature" placeholder="********"
          {{ isset($editObjectInstance) ? '' : 'required' }} />
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
