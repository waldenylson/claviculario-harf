@extends('layouts.app')
@section('content_body')
  @include('support.flash-message')
  <div class="card  direct-chat" style="width: 90%">
    <div class="card-header">
      <h1 class="card-title">Editar Usuário do Efetivo</h1>
    </div>
    {{ html()->form('PUT', route('efetivo.update', $user->id))->class('g-3 needs-validation')->novalidate()->open() }}

    @include('efetivo.partials.form')

    {{ html()->form()->close() }}
  </div>
@stop

