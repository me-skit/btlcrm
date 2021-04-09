@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- the query thing -->
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2 id="title" data-name="members"><i class="fas fa-users"></i> Miembros</h2>
        <div>
          <a href="{{ route('people.index') }}" class="btn btn-light"><i class="fas fa-redo-alt"></i> Recargar</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="row form-group">
            <label for="query_type" class="col-md-3 col-lg-2 col-form-label text-md-right">{{ __('Consultar') }}</label>
            <div class="col-md-9">
              <select name="query_type" id="query_type" class="form-control" required>
                <option value="1">Por nombre</option>
                <option value="2">Por cede</option>
                <option value="3">Por preferencia de privilegio</option>
                <option value="4">Bautizados</option>
                <option value="5">No bautizados</option>
                <option value="6">Aceptados</option>
                <option value="7">No aceptados</option>
                <option value="8">Con enfermedades</option>
                <option value="9">Con discapacidades</option>
              </select>
            </div>           
        </div>
      </div>
    
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-8 form-group for-query" id="by-name">
            <div class="input-group">
              <input type="text"
                name="search"
                id="search"
                class="form-control border-right-0 border @error('search') is-invalid @enderror"
                value="{{ old('search') }}"
                autofocus
                >
                <span class="input-group-append">
                  <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                </span>
            </div>
          </div>

          <div class="col-md-8 form-group for-query d-none" id="by-campus">
            <select name="campus_query" id="campus_query" class="form-control" required>
              @foreach ($campuses as $campus)
                <option value="{{ $campus->id }}">{{ $campus->name }}</option>                    
              @endforeach
            </select>
          </div>

          <div class="col-md-8 form-group for-query d-none" id="by-privilege">
            <select name="privilege_query" id="privilege_query" class="form-control" required>
              @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}">{{ $privilege->description }}</option>                    
              @endforeach
            </select>
          </div>          
        </div>
      </div>
    </div>

    <div id="pagination">
      @include('people.pagination')
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" id="modal-content">

    </div>
  </div>
</div>

@endsection