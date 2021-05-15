@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-map-marked"></i> Agregar Poblado</span>
          </div>
          <div class="card-body">
            <form action="{{ route('village.store') }}" method="post">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Nombre del pueblo o aldea"
                    required
                    autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-10 text-right">
                  <a href="{{ route('villages.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
                  <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection