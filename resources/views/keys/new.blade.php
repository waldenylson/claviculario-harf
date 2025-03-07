@extends('layouts.app')
@section('content_body')
  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Cadastrar Nova Chave</h1>
    </div>
    <div class="card-body bg-gray-500">
      @include('keys.partials.form', ['action' => route('keys.store'), 'method' => 'POST'])
    </div>
  </div>
@stop
