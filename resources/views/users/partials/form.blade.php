@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card  direct-chat" style="width: 90%">
  <div class="card-header">
    <h1 class="card-title">Criar Novo Usuário do Sistema</h1>

  </div>
  <!-- /.card-header -->
  <div class="card-body bg-gray-500">
    <div class="form-group well">
      <div class="container py-12">
        {{ html()->form('POST', '/usuarios/salvar')->class('g-3 needs-validation')->novalidate()->open() }}
        <div class="row">
          <div class="col-md-2">
            <label for="military_rank" class="form-label label">Post/Grad Esp</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-award"></i>
              </span>
              <input type="text" class="form-control" id="military_rank" name="military_rank" value="{{ old('military_rank') }}"
                required placeholder="1S SAD" />
            </div>
          </div>

          <div class="col-md-5">
            <label for="full_name" class="form-label label">Nome Completo</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-person-circle"></i>
              </span>
              <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
                required placeholder="Fulano de tal" />
            </div>
          </div>

          <div class="col-md-3">
            <label for="service_name" class="form-label label">Nome Guerra</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-tag"></i>
              </span>
              <input type="text" class="form-control" id="service_name" name="service_name" value="{{ old('service_name') }}"
                required placeholder="J. Fulano" />
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
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                placeholder="email@fab.mil.br" required>
            </div>
          </div>
          <div class="col-md-3">
            <label for="military_unit" class="form-label label">Unidade - Seção</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-diagram-3"></i>
              </span>
              <input type="text" class="form-control" id="military_unit" name="military_unit" value="{{ old('military_unit') }}"
                placeholder="CINDACTA III - TISI" required />
            </div>
          </div>
          <div class="col-md-3">
            <label for="phone" class="form-label label">Tel. Contato</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-telephone"></i>
              </span>
              <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                x-mask="(99) 99999-9999" placeholder="(99) 99999-9999" required />
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
              <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                required >
            </div>
          </div>

          <div class="col-md-3">
            <label for="password-confirm" class="form-label label">Confimar Senha</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                value="{{ old('password_confirmation') }}" required />
            </div>
          </div>

          <div class="col-md-4">
            <label for="electronic_signature" class="form-label label">Assinatura Eletrônica (Retirada de Chave)</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-shield-check"></i>
              </span>
              <input type="password" class="form-control" id="electronic_signature" name="electronic_signature"
                value="{{ old('electronic_signature') }}" required />
            </div>
          </div>
        </div>

        <hr style="margin-bottom: 5px; background-color:aliceblue" />
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
        </button>
        <button class="btn btn-danger" id="btn-cancelar" type="reset">
          <i class="fa fa-remove"></i>&nbsp;&nbsp;Limpar
        </button>
        {{ html()->form()->close() }}
      </div>
    </div>
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

