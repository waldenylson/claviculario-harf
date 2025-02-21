@extends('adminlte::page')

{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

@section('title', 'Dashboard')

@section('content_header')
  <hr>
@stop

@section('content')
  @yield('content_body')
@stop

@section('css')
  @vite('resources/css/custom.css')
@stop


@section('js')
  <script>
    console.log('Hi!');
  </script>
@stop

