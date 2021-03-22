@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Puestos en Privilegios</h2>
        <div>
          <a href="{{ route('privilegerole.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover table-responsive-md">
          <thead>
            <tr>
              <th>No.</th>
              <th>Descripción</th>
              <th>Fecha de Creación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($privilegeRoles as $key => $privilegeRole)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $privilegeRole->description }}</td>
                <td>{{ date_format($privilegeRole->created_at, 'd/m/Y H:i:s') }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('privilegerole.edit', $privilegeRole->id) }}" class="btn btn-primary mr-3">Editar</a>

                    <form action="{{ route('privilegerole.destroy', $privilegeRole->id) }}" method="post">
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

        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            {{ $privilegeRoles->links("pagination::bootstrap-4") }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection()