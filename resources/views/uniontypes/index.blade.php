@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-8 d-flex justify-content-between align-items-baseline">
        <h2>Tipos de Unión</h2>
        <div>
          <a href="{{ route('uniontype.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th>No.</th>
              <th>Descripción</th>
              <th>Fecha de Creación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($uniontypes as $key => $uniontype)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $uniontype->description }}</td>
                <td>{{ date_format($uniontype->created_at, 'M jS Y H:i:s') }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('uniontype.edit', $uniontype->id) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('uniontype.destroy', $uniontype->id) }}" method="POST">
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