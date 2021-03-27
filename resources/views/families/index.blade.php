@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2 id="title" data-name="families">Familias</h2>
        <div>
          <a href="{{ route('family.create') }}" class="btn btn-success">Agregar</a>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-5 col-md-4 col-lg-3 offset-md-1">
        <input type="text"
          name="search"
          id="search"
          class="form-control @error('search') is-invalid @enderror"
          value="{{ old('search') }}"
          autofocus
        >
      </div>
    </div>

    <div id="pagination">
      @include('families.pagination')
    </div>
  </div>
@endsection