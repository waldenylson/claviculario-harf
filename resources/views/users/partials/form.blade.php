<!-- /.card-header -->
<div class="card-body bg-gray-500">
  <div class="form-group well">
    <div class="container py-12">
      <div class="row">
        <div class="col-md-2">
          <label for="military_rank" class="form-label label">Post/Grad Esp</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-award"></i>
            </span>
            <input type="text" class="form-control" id="military_rank" name="military_rank"
              value="{{ old('military_rank', $user->military_rank ?? '') }}" required placeholder="1S SAD" />
          </div>
        </div>

        <div class="col-md-5">
          <label for="full_name" class="form-label label">Nome Completo</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-person-circle"></i>
            </span>
            <input type="text" class="form-control" id="full_name" name="full_name"
              value="{{ old('full_name', $user->full_name ?? '') }}" required placeholder="Fulano de tal" />
          </div>
        </div>

        <div class="col-md-3">
          <label for="service_name" class="form-label label">Nome Guerra</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-tag"></i>
            </span>
            <input type="text" class="form-control" id="service_name" name="service_name"
              value="{{ old('service_name', $user->service_name ?? '') }}" required placeholder="J. Fulano" />
          </div>
        </div>
      </div><br />

      <div class="row">
        <div class="col-md-4">
          <label for="email" class="form-label label">E-Mail FAB</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-envelope-at"></i>
            </span>
            <input type="email" class="form-control" id="email" name="email"
              value="{{ old('email', $user->email ?? '') }}" placeholder="email@fab.mil.br" required>
          </div>
        </div>
        <div class="col-md-3">
          <label for="military_unit" class="form-label label">Unidade - Seção</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-diagram-3"></i>
            </span>
            <input type="text" class="form-control" id="military_unit" name="military_unit"
              value="{{ old('military_unit', $user->military_unit ?? '') }}" placeholder="CINDACTA III - TISI"
              required />
          </div>
        </div>
        <div class="col-md-3">
          <label for="phone" class="form-label label">Tel. Contato</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-telephone"></i>
            </span>
            <input type="text" class="form-control masked-cel-phone" id="phone" name="phone"
              value="{{ old('phone', $user->phone ?? '') }}" placeholder="(99) 99999-9999" required />
          </div>
        </div>
      </div><br />
      <div class="row">
        <div class="col-md-3">
          <label for="password" class="form-label label">Senha</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-lock"></i>
            </span>
            <input type="password" class="form-control" id="password" name="password"
              {{ isset($user) ? '' : 'required' }}>
          </div>
        </div>

        <div class="col-md-3">
          <label for="password_confirm" class="form-label label">Confimar Senha</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-lock"></i>
            </span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
              {{ isset($user) ? '' : 'required' }}>
          </div>
        </div>

        <div class="col-md-4">
          <label for="electronic_signature" class="form-label label">Assinatura Eletrônica </label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-pen"></i>
            </span>
            <input type="password" class="form-control" id="electronic_signature" name="electronic_signature"
              {{ isset($user) ? '' : 'required' }} />
          </div>
        </div>
      </div> <br />

      <div class="row">
        <div class="col-sm-10" id="htmlTarget">
          <label for="datetimepicker1Input" class="form-label">Teste Tempus Dominus Date&Time Picker Lib</label>
          <div class="input-group log-event" id="datetimepicker1" data-td-target-input="nearest"
            data-td-target-toggle="nearest">
            <input id="datetimepicker1Input" type="text" class="form-control" data-td-target="#datetimepicker1"
              value="{{ old('datetimepicker1Input', $user->datetimepicker1Input ?? '') }}" />
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker">
              <i class="fas fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>

      <hr style="margin-bottom: 5px; background-color:aliceblue" />
      <button class="btn btn-primary" type="submit">
        <i class="fa fa-save"></i>&nbsp;&nbsp;{{ isset($user) ? 'Atualizar' : 'Salvar' }}
      </button>
      <button class="btn btn-danger" id="btn-cancelar" type="reset">
        <i class="fa fa-remove"></i>&nbsp;&nbsp;Limpar
      </button>
    </div>
  </div>

  <script>
    (() => {
      'use strict'

      const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

  <style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }
  </style>
