@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Editar Movimentação de Chave</h1>
    <form action="{{ route('key_movements.update', $movement->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="key_id">Chave</label>
        <select name="key_id" id="key_id" class="form-control">
          @foreach ($keys as $key)
            <option value="{{ $key->id }}" {{ $movement->key_id == $key->id ? 'selected' : '' }}>{{ $key->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="staff_id">Efetivo</label>
        <select name="staff_id" id="staff_id" class="form-control">
          @foreach ($staff as $s)
            <option value="{{ $s->id }}" {{ $movement->staff_id == $s->id ? 'selected' : '' }}>{{ $s->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="user_id">Usuário</label>
        <select name="user_id" id="user_id" class="form-control">
          @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $movement->user_id == $user->id ? 'selected' : '' }}>
              {{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
@endsection
