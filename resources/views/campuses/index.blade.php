@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h3><i class="fas fa-place-of-worship"></i> Sedes</h3>
        <div>
          <a href="{{ route('campus.create') }}" class="btn btn-success"><i class="fas fa-plus"></i><span class="d-none d-lg-inline"> Agregar</span></a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-sm table-hover table-responsive-md">
          <thead>
              <tr>
                  <th class="text-center">No.</th>
                  <th>Nombre</th>
                  <th>Poblado</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($campuses as $key => $campus)
              <tr>
                <td class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle text-truncate">{{ $campus->name }}</td>
                <td class="align-middle text-truncate">{{ $campus->village->name }}</td>
                <td class="align-middle text-truncate">{{ $campus->address }}</td>
                <td class="align-middle">
                  <div class="d-flex">
                    <a href="{{ route('campus.edit', $campus->id ) }}" class="btn btn-sm btn-primary mr-3"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>

                    <form action="{{ route('campus.destroy', $campus->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i><span class="d-none d-lg-inline"> Eliminar</span></button>
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