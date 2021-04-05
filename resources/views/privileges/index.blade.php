@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2 id="title" data-name="privileges"><i class="fas fa-user-tie"></i> Privilegios</h2>
        <div>
          <a href="{{ route('privilege.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Agregar</a>
        </div>
      </div>
    </div>

    <div class="row form-group">
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