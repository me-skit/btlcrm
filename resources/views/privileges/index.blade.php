@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-8 d-flex justify-content-between align-items-baseline">
        <h2>Privilegios</h2>
        <div>
          <a href="{{ route('privilege.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nombre</th>
              <th>Preferencias para el puesto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($privileges as $key => $privilege)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $privilege->description }}</td>
                <td>
                  <?php 
                    $preferrences = '';
                    $preferrences .= $privilege->preferred_sex ? ($privilege->preferred_sex == 'M' ? 'Sexo masculino' : 'Sexo femenino') : 'Ambos sexos';

                    if ($privilege->preferred_status) {
                      if ($privilege->preferred_sex) {
                        if ($privilege->preferred_sex == 'M') {
                          $preferrences .= $privilege->preferred_status == 1 ? ', casado' : ($privilege->preferred_status == 2 ? ', soltero' : ($privilege->preferred_status == 3 ? ', unido' : ', casado o unido'));
                        }
                        else {
                          $preferrences .= $privilege->preferred_status == 1 ? ', casada' : ($privilege->preferred_status == 2 ? ', soltera' : ($privilege->preferred_status == 3 ? ', unida' : ', casada o unida'));
                        }
                      }
                      else {
                        $preferrences .= $privilege->preferred_status == 1 ? ', casado(a)' : ($privilege->preferred_status == 2 ? ', soltero(a)' : ($privilege->preferred_status == 3 ? ', unido(a)' : 'casado(a) o soltero(a)'));
                      }
                    }
                    else {
                      $preferrences .= ', cualquier estado civil';
                    }
                    
                    if ($privilege->max_age and $privilege->min_age) {
                      $preferrences .= ', edades entre ' . $privilege->min_age . ' y ' . $privilege->max_age . ' años';
                    }

                    if ($preferrences == '') {
                      $preferrences = 'Abierto a todos los miembros';
                    }
                  ?>
                  {{ $preferrences }}
                </td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('privilege.edit', $privilege->id) }}" class="btn btn-primary mr-3">Editar</a>
                    
                    <form action="{{ route('privilege.destroy', $privilege->id) }}" method="POST">
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