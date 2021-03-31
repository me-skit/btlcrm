@extends('layouts.app')

@section('content')
  <div class="container p-4">
    <div class="header">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="pull-left d-flex align-items-baseline justify-content-between">
            <h3 id="family_name">{{ $family->family_name }}</h3>
            <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#editModal">Editar</a>
          </div>
        </div>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-5">
          Ubicación:
          <b>{{ $family->village->name }}</b>
        </div>
        <div class="col-md-5">
          Dirección:
          <b>{{ $family->address }}</b>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-5">
          Teléfono residencial:
          <b>{{ $family->phone_number }}</b>
        </div>
        <div class="col-md-5">
          Tipo de unión:
          <b>{{ $family->union_type == 1 ? "Casados" : "Unidos" }}</b>
        </div>        
      </div>    
    </div>
    
    <div class="row d-flex justify-content-center my-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h4>Miembros:</h4>
        <div>
          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#personAddModal">Agregar</a>
        </div>
      </div>
    </div>

    <div class="row d-flex justify-content-center mb-2">
      <div class="col-md-10">
        <div id="accordion">
          @foreach ($family->members as $member)
            <div class="card">
              <div class="card-header bg-secondary py-2" id="heading-{{ $member->id }}">
                <h5 class="mb-0 d-flex justify-content-between">
                  <button class="btn btn-link text-light collapsed py-0" data-toggle="collapse" data-target="#collapse-{{ $member->id }}" aria-expanded="false" aria-controls="collapse-{{ $member->id }}">
                    {{ $member->first_name . " " . $member->second_name . " " . $member->third_name . " " . $member->first_surname . " " . $member->second_surname }} 
                    {!! $member->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
                  </button>
                  <a href="{{ route('family.editmember', [$family->id, $member->id]) }}" class="btn btn-primary mr-3 py-0 {{  $member->death_date ? 'disabled' : '' }}">Editar</a>
                </h5>
              </div>
          
              <div id="collapse-{{ $member->id }}" class="collapse" aria-labelledby="heading-{{ $member->id }}" data-parent="#accordion">
                <div class="card-body">

                  @include('families.members.show')
                  
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 offset-md-1">
        {{-- <a href="{{ route('families.index') }}" class="btn btn-dark mr-3">&laquo; Listado de Familias</a> --}}
        <a href="{{ route('root') . '/' . $back }}" class="btn btn-dark mr-3">&laquo; Regresar</a>
      </div>
    </div>
  </div>

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