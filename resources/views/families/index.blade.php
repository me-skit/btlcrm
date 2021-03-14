@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2>Familias</h2>
        <div>
          <a href="{{ route('family.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <table class="table table-hover table-responsive-md">
          <thead>
              <tr>
                  <th>No.</th>
                  <th>Apellidos de Familia</th>
                  <th>Lugar</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($families as $key => $family)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $family->family_name }}</td>
                <td>{{ $family->village->name }}</td>
                <td>{{ $family->address }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('family.show', $family->id ) }}" class="btn btn-primary mr-3">Detalles</a>
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