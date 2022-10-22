@extends('layouts.app')

@section('content')
  <style>
    .copy {
      cursor: copy;
    }
  </style>
  <div class="container p-4">
    <div class="header">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12">
          <div class="pull-left d-flex align-items-baseline justify-content-between">
            <h3 id="family_name"><i class="fa fa-home"></i> {{ $family->family_name }}</h3>
            <div>
              @can('administer')
                <a href="#" class="btn btn-danger mr-2" data-toggle="modal" data-target="#delFamilyModal"><i class="far fa-trash-alt"></i><span class="d-none d-lg-inline"> Eliminar</span></a>
              @endcan
              <a href="{{ route('family.edit', $family->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
            </div>
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
    
    <div class="row d-flex justify-content-center py-2 my-1 bg-light">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h4>Miembros:</h4>
        <div>
          @can('administer')
            <a href="#" class="btn btn-info mr-2" id="btn-import-1" data-toggle="modal" data-target="#importModal"><i class="far fa-file-import"></i><span class="d-none d-lg-inline"> Importar</span></a>
          @endcan
          <a href="{{ route('family.createmember', $family->id) }}" class="btn btn-success"><i class="fas fa-plus"></i><span class="d-none d-lg-inline"> Agregar</span></a>
        </div>
      </div>
    </div>

    <div class="row d-flex justify-content-center mb-2">
      <div class="col-md-12">
        <div id="accordion">
          @foreach ($family->members as $person)
            <div class="card">
              <div class="card-header bg-secondary py-2 px-0" id="heading-{{ $person->id }}">
                <h5 class="mb-0 d-flex justify-content-between">
                  <button class="btn btn-link text-light collapsed py-0 text-truncate" data-toggle="collapse" data-target="#collapse-{{ $person->id }}" aria-expanded="false" aria-controls="collapse-{{ $person->id }}">
                    <i class="far fa-address-card"></i> {{ $person->full_name }}
                    {!! $person->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
                  </button>
                  <div>
                    @can('administer')
                      <a href="#" class="btn btn-danger mr-1 py-0 btn-delperson" data-toggle="modal" data-target="#delPersonModal" data-person-id="{{  $person->id }}" data-person-name="{{  $person->full_name }}" data-family-id="{{  $family->id }}"><i class="far fa-trash-alt"></i><span class="d-none d-lg-inline"> Eliminar</span></a>
                    @endcan
                    <a href="{{ route('family.editmember', [$family->id, $person->id]) }}" class="btn btn-primary mr-3 py-0"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
                  </div>
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

  @can('administer')
    <!-- confirm delete family -->
    <div class="modal fade" id="delFamilyModal" tabindex="-1" role="dialog" aria-labelledby="delFamilyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="delFamilyModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Familia</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="del-priv-modal">
            <p>Confirme eliminación de datos de esta familia.</p>
            <p>Los datos de los miembros deben ser eliminados antes.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <form method="POST" action="{{ route('family.destroy', $family) }}">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- confirm delete person info -->
    <div class="modal fade" id="delPersonModal" tabindex="-1" role="dialog" aria-labelledby="delPersonModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="delPersonModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Datos</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="del-priv-modal">
            <p id="del-person-text">Confirme eliminación de datos de esta persona.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <form id="deleteperson-form" action="#" method="POST" data-root="{{ url('/') }}">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger" id="btn-del-person">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

      <!-- import person modal -->
      <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <form id="import-form" action="#" method="POST" data-root="{{ url('/') }}" data-family-id="{{ $family->id }}">
              @csrf
              @method('PATCH')


              <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel"><b><i class="far fa-file-import"></i> Mover Persona</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="del-priv-modal">
                

                <div class="row">
                  <div class="col-md-8">
                    <div class="row form-group">
                      <label for="code" class="col-md-5 col-form-label text-md-right">{{ __('Código') }}<span class="text-danger">*</span></label>
                      <div class="col-md-7">
                        <input type="text" name="code" id="code" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <a href="#" class="btn btn-primary" id="btn-load">Cargar</a>
                  </div>
                </div>
                <div id="person-info">

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="btn-import-2" disabled>Importar</button>
              </div>



            </form>
          </div>
        </div>
      </div>
  @endcan

  <script
    src="https://maps.googleapis.com/maps/api/js?key=<API_KEY>&callback=initMap&libraries=&v=weekly"
    async
  >
  </script>
@endsection