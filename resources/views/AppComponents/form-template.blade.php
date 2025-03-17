@props(['featureInstance'])

<div class="card-body bg-gray-500">
  <div class="form-group well">
    <div class="container py-12">

      {{ $slot }}

      <hr style="margin-bottom: 5px; background-color:aliceblue" />
      <button class="btn btn-primary" id="btn-submit" type="submit">
        <i class="fa fa-save"></i>&nbsp;&nbsp;{{ isset($featureInstance) ? 'Atualizar' : 'Salvar' }}
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
</div>
