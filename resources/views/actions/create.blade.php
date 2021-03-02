@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Agregar Nueva Función</span>
          </div>

          <div class="card-body">
            <form action="{{ route('action.store') }}" method="post">
              @csrf

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') }}"
                    required
                    autocomplete="description"
                    autofocus>

                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('Path') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="path"
                    id="path"
                    class="form-control @error('path') is-invalid @enderror"
                    value="{{ old('path') }}"
                    required
                    autocomplete="path"
                    autofocus>

                  @error('path')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icono') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="icon"
                    id="icon"
                    class="form-control @error('icon') is-invalid @enderror"
                    value="{{ old('icon') }}"
                    required
                    autocomplete="icon"
                    autofocus>

                  @error('icon')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Agregar</button>
                  <a href="{{ route('actions.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection