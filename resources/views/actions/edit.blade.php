@extends('layouts.app')

@section('content')
  <div class="containier">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Editar Función</span>
          </div>

          <div class="card-body">
            <form action="{{ route('action.update', $action->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') ?? $action->description }}"
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

              <div class="row form-group">
                <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('Path') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                    name="path"
                    id="path"
                    class="form-control @error('path') is-invalid @enderror"
                    value="{{ old('path') ?? $action->path }}"
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
                    value="{{ old('icon') ?? $action->icon }}"
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
                <div class="col-md6 offset-md-4">
                  <button class="btn btn-primary">Modificar</button>
                </div>

                <a href="{{ route('actions.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
