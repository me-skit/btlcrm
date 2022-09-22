@extends('layouts.app')

@section('content')
  <div class="container p-4">
    <div class="header">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12">
          <div class="pull-left d-flex align-items-baseline justify-content-between">
            <h3 id="family_name"><i class="fa fa-home"></i> {{ $family->family_name }}</h3>
            <a href="{{ route('family.edit', $family->id) }}" class="btn btn-primary ml-2"><i class="fas fa-pencil-alt"></i> Editar</a>
          </div>
        </div>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          Ubicación:
          <b>{{ $family->village->name }}</b>
        </div>
        <div class="col-md-6">
          Dirección:
          <b>{{ $family->address . ', zona ' . $family->zone }}</b>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          Teléfono residencial:
          <b>{{ $family->phone_number }}</b>
        </div>
        <div class="col-md-6">
          Tipo de unión:
          <b>{{ $family->union }}</b>
        </div>        
      </div>    
    </div>
    
    <div class="row d-flex justify-content-center py-2 bg-light">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h4>Miembros:</h4>
        <div>
          <a href="{{ route('family.createmember', $family->id) }}" class="btn btn-success"><i class="fas fa-plus"></i> Agregar</a>
        </div>
      </div>
    </div>

    <div class="row d-flex justify-content-center mb-2">
      <div class="col-md-12">
        <div id="accordion">
          @foreach ($family->members as $person)
            <div class="card">
              <div class="card-header bg-secondary py-2" id="heading-{{ $person->id }}">
                <h5 class="mb-0 d-flex justify-content-between">
                  <button class="btn btn-link text-light collapsed py-0" data-toggle="collapse" data-target="#collapse-{{ $person->id }}" aria-expanded="false" aria-controls="collapse-{{ $person->id }}">
                    <i class="far fa-address-card"></i> {{ $person->full_name }}
                    {!! $person->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
                  </button>
                  <a href="{{ route('family.editmember', [$family->id, $person->id]) }}" class="btn btn-primary mr-3 py-0 {{  $person->death_date ? 'disabled' : '' }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                </h5>
              </div>
          
              <div id="collapse-{{ $person->id }}" class="collapse" aria-labelledby="heading-{{ $person->id }}" data-parent="#accordion">
                <div class="card-body">

                  @include('people.show.info')
                  
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div id="map" class="mt-3" data-map="3" data-lat="{{ $family->latitude }}" data-lng="{{ $family->longitude }}"></div>
      </div>
    </div>
  </div>

  @include('people.show.modals')

  <script
    src="https://maps.googleapis.com/maps/api/js?key=<API_KEY>&callback=initMap&libraries=&v=weekly"
    async
  >
  </script>
@endsection