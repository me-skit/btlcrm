@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header font-weight-bold">{{ __('Cambio de Contraseña') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('user.reset') }}">
            @csrf
            @method('PATCH')

            <div class="form-group row">
              <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña actual') }}</label>
              <div class="col-md-6">
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

                @error('current_password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
              <div class="col-md-6">
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>

                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>            

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Cambiar Contraseña') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
