@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Agregar Nueva Sede</span>
          </div>

          <div class="card-body">
            <form action="{{ route('campus.store') }}" method="post">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="address"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') }}"
                    required
                    autocomplete="address"
                    autofocus>

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('Longitud') }}</label>
                <div class="col-md-6">
                  <input type="number"
                    name="longitude"
                    id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror"
                    value="{{ old('longitude') }}"
                    autocomplete="longitude"
                    autofocus>

                  @error('longitude')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('Latitud') }}</label>
                <div class="col-md-6">
                  <input type="number"
                    name="latitude"
                    id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror"
                    value="{{ old('latitude') }}"
                    autocomplete="latitude"
                    autofocus>

                  @error('latitude')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Agregar</button>
                  <a href="{{ route('campus.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection