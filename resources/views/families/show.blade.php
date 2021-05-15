@extends('layouts.app')

@section('content')
  <div class="container p-4">
    <div class="header">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="pull-left d-flex align-items-baseline justify-content-between">
            <h3 id="family_name"><i class="fa fa-home"></i> {{ $family->family_name }}</h3>
            <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i> Editar</a>
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
          <b>{{ $family->union }}</b>
        </div>        
      </div>    
    </div>
    
    <div class="row d-flex justify-content-center py-2 bg-light">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h4>Miembros:</h4>
        <div>
          <a href="{{ route('family.createmember', $family->id) . '?back=' . $back }}" class="btn btn-success"><i class="fas fa-plus"></i> Agregar</a>
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
                    <i class="far fa-address-card"></i> {{ $member->full_name }}
                    {!! $member->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
                  </button>
                  <a href="{{ route('family.editmember', [$family->id, $member->id]) . '?back=' . $back }}" class="btn btn-primary mr-3 py-0 {{  $member->death_date ? 'disabled' : '' }}"><i class="fas fa-pencil-alt"></i> Editar</a>
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
      <div class="col-md-10 offset-md-1 text-right">
        <a href="{{ route('root') . '/' . $back }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i> Regresar</a>
      </div>
    </div>
  </div>

  <!-- Edit family's modal -->
  @include('families.edit')
@endsection