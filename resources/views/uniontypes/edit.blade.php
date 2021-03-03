@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Editar Tipo de Unión</span>
          </div>

          <div class="card-body">
            <form action="{{ route('uniontype.update', $unionType->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}<span class="text-danger">*</span></label>

                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') ?? $unionType->description }}"
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

              <div class="row form-group mb-0">
                <div class="col-md-6 offset-md-4">
                  <button class="btn btn-primary">Modificar</button>
                  <a href="{{ route('uniontypes.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
