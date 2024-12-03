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
        {{ html()->form('POST', '/')->class('g-3 needs-validation')->novalidate()->open() }}
        <div class="row">
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label label">First name</label>
            <input type="text" class="form-control" id="validationCustom01" value="" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label label">Last name</label>
            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
          </div>
        </div> <br />
        <div class="row">
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label label">First name</label>
            <input type="text" class="form-control" id="validationCustom01" value="" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label label">Last name</label>
            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
          </div>
        </div>
        <hr style="margin-bottom: 5px" />
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
