<!-- filepath: /home/waldenylson/Projetos/claviculario-harf/resources/views/harf_staff/partials/form.blade.php -->
<!-- /.card-header -->
<div class="card-body bg-gray-500">
  <div class="form-group well">
    <div class="container py-12">
      <div class="row">
        <div class="col-md-5">
          <label for="name" class="form-label label">Nome Completo</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-person-circle"></i>
            </span>
            <input type="text" class="form-control" id="name" name="name"
              value="{{ old('name', $harf_staff->name ?? '') }}" required placeholder="Fulano de tal" />
          </div>
        </div>

        <div class="col-md-4">
          <label for="email" class="form-label label">E-Mail</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-envelope-at"></i>
            </span>
            <input type="email" class="form-control" id="email" name="email"
              value="{{ old('email', $harf_staff->email ?? '') }}" placeholder="email@example.com">
          </div>
        </div>

        <div class="col-md-3">
          <label for="phone" class="form-label label">Tel. Contato</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-telephone"></i>
            </span>
            <input type="text" class="form-control" id="phone" name="phone"
              value="{{ old('phone', $harf_staff->phone ?? '') }}" placeholder="(99) 99999-9999" required />
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
              {{ isset($harf_staff) ? '' : 'required' }}>
          </div>
        </div>

        <div class="col-md-3">
          <label for="password_confirmation" class="form-label label">Confimar Senha</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-lock"></i>
            </span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
              {{ isset($harf_staff) ? '' : 'required' }}>
          </div>
        </div>

        <div class="col-md-4">
          <label for="electronic_signature" class="form-label label">Assinatura Eletrônica</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-pen"></i>
            </span>
            <input type="text" class="form-control" id="electronic_signature" name="electronic_signature"
              value="{{ old('electronic_signature', $harf_staff->electronic_signature ?? '') }}" required />
          </div>
        </div>
      </div> <br />

      <hr style="margin-bottom: 5px; background-color:aliceblue" />
      <button class="btn btn-primary" type="submit">
        <i class="fa fa-save"></i>&nbsp;&nbsp;{{ isset($harf_staff) ? 'Atualizar' : 'Salvar' }}
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
