@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Estado Civil</span>
          </div>

          <div class="card-body">
            <form action="{{ route('status.store') }}" method="POST">
              @csrf

              <div class="row form-group">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                <div class="col-md-6">
                  <input type="text"
                      name="description"
                      id="description"
                      class="form-control @error('description') is-invalid @enderror"
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
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a href="{{ route('status.index') }}" class="btn btn-secondary ml-1">Cancelar</a>
                  </div>
                </div>              
            </form>          
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
