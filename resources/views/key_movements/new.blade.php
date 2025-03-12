<!-- filepath: d:\Waldenylson\Projetos\claviculario-harf\resources\views\key_movements\new.blade.php -->
@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Nova Movimentação de Chave</h1>
    <form action="{{ route('key_movements.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="key_id">Chave</label>
        <select name="key_id" id="key_id" class="form-control">
          @foreach ($keys as $key)
            <option value="{{ $key->id }}">{{ $key->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="staff_id">Efetivo</label>
        <select name="staff_id" id="staff_id" class="form-control">
          @foreach ($staff as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="user_id">Usuário</label>
        <select name="user_id" id="user_id" class="form-control">
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
@endsection
