@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h3 id="title" data-name="privileges"><i class="fas fa-user-tie"></i> Ministerios</h3>
        <div class="d-print-none">
          <a id="btn-print" href="#" class="btn btn-light mr-2"><i class="fas fa-print"></i><span class="d-none d-lg-inline"> Imprimir</span></a>
          <a href="{{ route('privilege.create') }}" class="btn btn-success"><i class="fas fa-plus"></i><span class="d-none d-lg-inline"> Agregar</span></a>
        </div>
      </div>
    </div>

    <div class="row form-group d-print-none">
      <div class="col-sm-7 col-md-5 col-lg-4 offset-md-1">
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
    </div>

    <div id="pagination">
      @include('privileges.pagination')
    </div>
  </div>
@endsection