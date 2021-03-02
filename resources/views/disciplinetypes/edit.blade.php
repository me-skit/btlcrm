@extends('layouts.app')

@section('content')
  <div class="containier">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Editar Tipo de Disciplina</span>
          </div>

          <div class="card-body">
            <form action="{{ route('disciplinetype.update', $disciplineType->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') ?? $disciplineType->description }}"
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
                <label for="months" class="col-md-4 col-form-label text-md-right">{{ __('Meses') }}</label>
                <div class="col-md-6">
                  <input type="number"
                    name="months"
                    id="months"
                    class="form-control @error('months') is-invalid @enderror"
                    value="{{ old('months') ?? $disciplineType->months }}"
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
                <div class="col-md6 offset-md-4">
                  <button class="btn btn-primary">Modificar</button>
                </div>

                <a href="{{ route('disciplinetypes.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
