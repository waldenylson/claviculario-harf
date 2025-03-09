@extends('layouts.app')
@section('content_body')
  @include('support.flash-message')
  <div class="card  direct-chat" style="width: 90%">
    <div class="card-header">
      <h1 class="card-title">Editar Chave Cadastrada</h1>
    </div>
    {{ html()->form('PUT', route('keys.update', $key->id))->class('g-3 needs-validation')->novalidate()->open() }}
      @csrf
      @include('keys.partials.form', ['featureInstance' => $key])
    {{ html()->form()->close() }}
  </div>
@stop