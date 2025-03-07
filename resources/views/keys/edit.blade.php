@extends('layouts.app')
@section('content_body')
  <div class="card direct-chat" style="width: 98%">
    <div class="card-header">
      <h1 class="card-title">Editar Chave</h1>
    </div>
    <div class="card-body bg-gray-500">
      @include('keys.partials.form', [
          'action' => route('keys.update', $key->id),
          'method' => 'PUT',
          'editObjectInstance' => $key,
      ])
    </div>
  </div>
@stop
