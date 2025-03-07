@extends('layouts.app')
@section('content_body')
  @include('support.flash-message')
  <div class="card direct-chat" style="width: 90%">
    <div class="card-header">
      <h1 class="card-title">Editar Seção</h1>
    </div>
    {{ html()->form('PUT', route('departments.update', $department->id))->class('g-3 needs-validation')->novalidate()->open() }}
    @csrf
    @include('departments.partials.form', ['featureInstance' => $department])
    {{ html()->form()->close() }}
  </div>
@stop
