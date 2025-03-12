@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Movimentações de Chaves</h1>
    <a href="{{ route('key_movements.create') }}" class="btn btn-primary">Nova Movimentação</a>
    <table class="table mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Chave</th>
          <th>Efetivo</th>
          <th>Usuário</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($movements as $movement)
          <tr>
            <td>{{ $movement->id }}</td>
            <td>{{ $movement->key->name }}</td>
            <td>{{ $movement->staff->name }}</td>
            <td>{{ $movement->user->name }}</td>
            <td>{{ $movement->created_at }}</td>
            <td>
              <a href="{{ route('key_movements.edit', $movement->id) }}" class="btn btn-warning">Editar</a>
              <form action="{{ route('key_movements.destroy', $movement->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
