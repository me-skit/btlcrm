@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2><i class="fas fa-place-of-worship"></i> Sedes</h2>
        <div>
          <a href="{{ route('campus.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Agregar</a>
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
                  <th>Poblado</th>
                  <th class="d-none d-md-block">Dirección</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($campuses as $key => $campus)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $campus->name }}</td>
                <td>{{ $campus->village->name }}</td>
                <td class="d-none d-md-block">{{ $campus->address }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('campus.edit', $campus->id ) }}" class="btn btn-primary mr-3"><i class="fas fa-pencil-alt"></i> Editar</a>

                    <form action="{{ route('campus.destroy', $campus->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
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