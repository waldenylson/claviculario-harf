@extends('adminlte::page')
@vite(['resources/css/app.css', 'resources/js/app.js'])


@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel...</p>
@stop

@section('css')
    @vite('resources/css/custom.css')
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
