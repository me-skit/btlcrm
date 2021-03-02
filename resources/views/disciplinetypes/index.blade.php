@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-8 d-flex justify-content-between align-items-baseline">
        <h2>Tipos de Disciplinas</h2>
        <div>
          <a href="{{ route('disciplinetype.create') }}" class="btn btn-success">Agregar</a>
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
                  <th>Meses</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($disciplineTypes as $key => $disciplineType)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $disciplineType->description }}</td>
                <td>{{ $disciplineType->months }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('disciplinetype.edit', $disciplineType->id ) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('disciplinetype.destroy', $disciplineType->id) }}" method="POST">
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