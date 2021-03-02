@extends('layouts.app')

@section('content')
  <div class="containier">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Editar Sede</span>
          </div>

          <div class="card-body">
            <form action="{{ route('campus.update', $campus->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') ?? $campus->name }}"
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

              <div class="row form-group">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="address"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') ?? $campus->address }}"
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
                    value="{{ old('longitude') ?? $campus->longitude }}"
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
                    value="{{ old('latitude') ?? $campus->latitude }}"
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
                <div class="col-md6 offset-md-4">
                  <button class="btn btn-primary">Modificar</button>
                </div>

                <a href="{{ route('campus.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
