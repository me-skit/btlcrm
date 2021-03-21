@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Usuarios</h2>
        <div>
          <a href="{{ route('user.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover table-responsive-md">
          <thead>
              <tr>
                  <th>No.</th>
                  <th>Correo</th>
                  <th>Estado</th>
                  <th class="d-none d-md-block">Rol</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($users as $key => $user)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->active ? 'Activo' : 'Desactivado' }}</td>
                <td class="d-none d-md-block">{{ $user->role }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-3">Editar</a>
                    {{-- @if($user->active)
                      <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="active" name="active" value="0">
                        <button type="submit" class="btn btn-secondary mr-2">Desactivar</button>
                      </form>
                    @else
                      <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="active" name="active" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Reactivar</button>
                      </form>
                    @endif --}}

                    {{-- <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form> --}}
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection