@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Sedes</h2>
        <div>
          <a href="{{ route('campus.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover">
          <thead class="thead-dark">
              <tr>
                  <th>No.</th>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($campuses as $key => $campus)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $campus->name }}</td>
                <td>{{ $campus->address }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('campus.edit', $campus->id ) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('campus.destroy', $campus->id) }}" method="POST">
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