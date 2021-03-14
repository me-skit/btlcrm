@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Poblados</h2>
        <div>
          <a href="{{ route('village.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover table-responsive-md">
          <thead>
              <tr>
                  <th>No.</th>
                  <th>Nombre</th>
                  <th>Fecha de Creación</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($villages as $key => $village)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $village->name }}</td>
                <td>{{ date_format($village->created_at, 'd/m/Y H:i:s') }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('village.edit', $village->id ) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('village.destroy', $village->id) }}" method="POST">
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