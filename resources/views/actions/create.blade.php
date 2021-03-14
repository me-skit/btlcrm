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
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') }}"
                    required
                    autofocus>

                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('Path') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                    name="path"
                    id="path"
                    class="form-control @error('path') is-invalid @enderror"
                    value="{{ old('path') }}"
                    required
                    >

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
                    >

                  @error('icon')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-10 text-right">
                  <a href="{{ route('actions.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
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