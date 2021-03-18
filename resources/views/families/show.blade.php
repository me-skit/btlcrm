@extends('layouts.app')

@section('content')
  <div class="container p-4">
    <div class="header">
      <div class="row">
        <div class="col-md-12">
          <div class="pull-left d-flex align-items-baseline justify-content-between">
            <h3>{{ $family->family_name }}</h3>
            <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#editModal">Editar</a>
          </div>
          <!-- <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('families.index') }}" title="Go back"> <i class="fas fa-backward ">Regresar</i></a>
          </div> -->
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          Ubicación:
          <b>{{ $family->village->name }}</b>
        </div>
        <div class="col-md-6">
          Dirección:
          <b>{{ $family->address }}</b>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          Teléfono residencial:
          <b>{{ $family->phone_number }}</b>
        </div>
        <div class="col-md-6">
          Tipo de unión:
          <b>{{ $family->union_type == 1 ? "Casados" : "Unidos" }}</b>
        </div>        
      </div>    
    </div>
    
    <div class="row my-3">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h4>Miembros:</h4>
        <div>
          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#personAddModal">Agregar</a>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <table class="table table-hover table-responsive-md mt-2">
          <thead class="table-primary">
            <th>No.</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Aceptado</th>
            <th>Bautizado</th>
            <th>Asiste</th>
            <th>Sede</th>
            <th>Acciones</th>
          </thead>
          <tbody>

            @foreach ($family->members as $key => $member)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                  {{ $member->first_name . " " . $member->second_name . " " . $member->third_name . " " . $member->first_surname . " " . $member->second_surname }} 
                  {!! $member->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
                </td>
                <td>{{ $member->pivot->family_role == 1 ? "Padre" : ($member->pivot->family_role == 2 ? "Madre" : ($member->pivot->family_role == 3 ? "Hijo" : "Hija")) }}</td>
                <td>{{ $member->membership->accepted ? "Si" : "No" }}</td>
                <td>{{ $member->membership->baptized ? "Si" : "No" }}</td>
                <td>
                  @if (!$member->death_date)
                    {{ $member->membership->attend_church ? ($member->membership->attend_church == 1 ? "Si" : "Otra iglesia") : "No" }}
                  @endif
                </td>
                <td>{{ $member->membership->campus_id ? $member->membership->campus->name : "" }}</td>
                <td>
                  <div class="d-flex">
                    <a href="#" class="btn btn-secondary mr-3" data-toggle="modal" data-target="#personShowModal-{{ $member->id }}">Detalles</a>
                    <a href="{{ route('family.editmember', [$family->id, $member->id]) }}" class="btn btn-primary mr-3 {{  $member->death_date ? 'disabled' : '' }}">Editar</a>
                  </div>
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <a href="{{ route('families.index') }}" class="btn btn-dark mr-3">&laquo; Terminar</a>
      </div>
    </div>
  </div>

  <!-- Show person info modal -->
  
  @include('families.members.show')

  <!-- Add new person info modal -->

  <form action="{{ route('family.addmember', $family->id) }}" method="POST">
    @csrf

    <div class="modal fade" id="personAddModal" tabindex="-1" role="dialog" aria-labelledby="personAddModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="personAddModalLabel"><span class="font-weight-bold">Agregar miembro</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            @include('families.members.addpartial')

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>  
  </form>

  <!-- Edit family's modal -->

  @include('families.edit')
@endsection