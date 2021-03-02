@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Listado de Acciones</h2>
        <div>
          <a href="{{ route('action.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover">
          <thead class="thead-dark">
              <tr>
                  <th>No.</th>
                  <th>Descripción</th>
                  <th>Path</th>
                  <th>Icono</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($actions as $key => $action)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $action->description }}</td>
                <td>{{ $action->path }}</td>
                <td>{{ $action->icon }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('action.edit', $action->id ) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('action.destroy', $action->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
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