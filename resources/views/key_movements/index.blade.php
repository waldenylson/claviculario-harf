@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Chaves Movimentadas sem Devolução</h1>

    <table class="table mt-3">
      <thead>
        <tr>
          <th>Chave</th>
          <th>Efetivo HARF</th>
          <th>Permanência</th>
          <th>Data/Hora</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($movements as $movement)
          <tr>
            <td>{{ $movement->key->number }}</td>
            <td>{{ $movement->harfStaff->name }}</td>
            <td>{{ $movement->user->military_rank . ' ' . $movement->user->service_name }}</td>
            <td>{{ \Carbon\Carbon::parse($movement->out)->format('d/m/Y H:i:s') }}</td>
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
    <!-- Links de Paginação -->
    <div class="d-flex justify-content-center">
      {{ $movements->links('vendor.pagination.bootstrap-5') }}
    </div>
  </div>
@endsection
