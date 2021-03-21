@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Registrar Usuario') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group row">
              <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('e-mail') }}<span class="text-danger">*</span></label>

              <div class="col-md-7">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email" readonly>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="row form-group">
                <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Rol') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                    <select name="role" class="form-control" required>
                    <option value="Registrador" {{ $user->role == 'Registrador' ? 'selected' : '' }}>Registrador</option>
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
              <label for="active" class="col-md-3 col-form-label text-md-right">{{ __('Activar/desactivar') }}<span class="text-danger">*</span></label>
              <div class="col-md-7">
                  <select name="active" id="active" class="form-control" required>
                    <option value="0" {{ $user->active ? '' : 'selected' }}>Desactivar</option>
                    <option value="1" {{ $user->active ? 'selected' : '' }}>Activo</option>
                  </select>
              </div>
            </div>      
            
            <div class="row form-group mb-0">
              <div class="col-md-10 text-right">
                <a href="{{ route('users.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    {{ __('Modificar') }}
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
