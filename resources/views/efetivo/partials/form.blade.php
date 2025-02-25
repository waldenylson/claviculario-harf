<!-- filepath: /home/waldenylson/Projetos/claviculario-harf/resources/views/harf_staff/partials/form.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Efetivo</h1>
    <form action="{{ route('efetivo.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="departament_id" class="form-label label">Departamento</label>
                <select class="form-control" id="departament_id" name="departament_id" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-4">
                <label for="phone" class="form-label label">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="col-md-4">
                <label for="extension" class="form-label label">Ramal</label>
                <input type="text" class="form-control" id="extension" name="extension">
            </div>
            <div class="col-md-4">
                <label for="military" class="form-label label">Militar</label>
                <select class="form-control" id="military" name="military" required>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-4">
                <label for="electronic_signature" class="form-label label">Assinatura Eletrônica</label>
                <input type="text" class="form-control" id="electronic_signature" name="electronic_signature" required>
            </div>
        </div><br />
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Limpar</button>
    </form>
</div>
@endsection

@section('scripts')
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
@endsection

@section('styles')
<style>
    .label {
      margin-bottom: 0px;
      margin-left: 5px;
    }
</style>
@endsection
