@extends('layouts.app')
@section('content_body')

  <div class="card  direct-chat" style="width: 90%">
    <div class="card-header">
        <h1 class="card-title">Criar Novo Usuário do Sistema</h1>
    </div>
    {{ html()->form('POST', '/usuarios/salvar')->class('g-3 needs-validation')->novalidate()->open() }}

        @include('users.partials.form')

    {{ html()->form()->close() }}
  </div>

  <!-- /.card-body -->
  <div class="card-footer">

  </div>
  <!-- /.card-footer-->

@stop

