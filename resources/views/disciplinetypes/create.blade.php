@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Agregar Nuevo Tipo de Disciplina</span>
          </div>

          <div class="card-body">
            <form action="{{ route('disciplinetype.store') }}" method="post">
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
                <label for="months" class="col-md-4 col-form-label text-md-right">{{ __('Meses') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="number"
                    name="months"
                    id="months"
                    class="form-control @error('months') is-invalid @enderror"
                    value="{{ old('months') }}"
                    required
                    autocomplete="months"
                    autofocus>

                  @error('months')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Agregar</button>
                  <a href="{{ route('disciplinetypes.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection