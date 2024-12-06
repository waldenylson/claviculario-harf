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
        {{ html()->form('GET', '/usuarios/novo')->class('g-3 needs-validation')->novalidate()->open() }}
        <div class="row">
          <div class="col-md-5">
            <label for="name" class="form-label label">Posto/Grad/Esp Nome Completo</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-person-circle"></i>
              </span>
              <input type="text" class="form-control" id="name" value="" required
                placeholder="1S SAD Fulano de Tal" />
            </div>
          </div>

          <div class="col-md-4">
            <label for="email" class="form-label label">E-Mail FAB</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-envelope-at"></i>
              </span>
              <input type="email" class="form-control" id="email" value="" placeholder="email@fab.mil.br"
                required>
            </div>
          </div>
        </div> <br />

        <div class="row">
          <div class="col-md-3">
            <label for="phone" class="form-label label">Tel. Contato</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-telephone"></i>
              </span>
              <input type="text" class="form-control" id="phone" value="" x-mask="(99) 99999-9999"
                placeholder="(99) 99999-9999" required />
            </div>
          </div>

          <div class="col-md-3">
            <label for="password" class="form-label label">Senha</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" class="form-control" id="password" value="" required
                autocomplete="new-password">
            </div>
          </div>

          <div class="col-md-3">
            <label for="password-confirm" class="form-label label">Confimar Senha</label>

            <div class="input-group">
              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>
              <input type="password" class="form-control" id="password_confirmation" value="" required
                autocomplete="new-password" />
            </div>
          </div>

        </div>
        <hr style="margin-bottom: 5px; background-color:aliceblue" />
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
        </button>
        <button class="btn btn-danger" id="btn-cancelar" type="button">
          <i class="fa fa-remove"></i>&nbsp;&nbsp;Cancelar
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

