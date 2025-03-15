@extends('layouts.app')
@section('content_body')
  @include('support.flash-message')
  <div class="card  direct-chat" style="width: 90%">
    <div class="card-header">
        <h1 class="card-title">Nova Movimentação de Chave</h1>
    </div>
    {{ html()->form('POST', route('key_movements.store'))->open() }}
        @csrf
        @include('key_movements.partials.form')
    {{ html()->form()->close() }}
  </div>
@stop