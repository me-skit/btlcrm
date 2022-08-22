@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-user-tie"></i> Privilegio</span>
          </div>

          <div class="card-body">
            <form action="{{ route('privilege.store') }}" method="POST">
              @csrf

              <div class="row form-group">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text"
                      name="name"
                      id="name"
                      class="form-control @error('name') is-invalid @enderror"
                      value="{{ old('name') }}"
                      placeholder="Nombre del privilegio"
                      required
                      autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">
                  <p><b>Preferencias </b>para indicar quienes pueden optar al cargo o privilegio según sexo, estado civil o edad:</p>
                </div>
              </div>


              <div class="row form-group">
                <label for="preferred_sex" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <select name="preferred_sex" class="form-control">
                    <option value selected>Masculino o femenino</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="preferred_status" class="col-md-4 col-form-label text-md-right">{{ __('Estado civil') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <select name="preferred_status" class="form-control">
                    <option value selected>Casado(a) o soltero(a)</option>
                    <option value="1">Soltero(a)</option>
                    <option value="2">Casado(a)</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="min_age" class="col-md-4 col-form-label text-md-right">{{ __('Edad mínima') }}</label>
                <div class="col-md-6">
                  <input type="number" min="1"
                      name="min_age"
                      id="min_age"
                      class="form-control @error('min_age') is-invalid @enderror"
                      value="{{ old('min_age') }}"
                      placeholder="Edad mínima"
                      >

                    @error('min_age')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="max_age" class="col-md-4 col-form-label text-md-right">{{ __('Edad máxima') }}</label>
                <div class="col-md-6">
                  <input type="number" min="1"
                      name="max_age"
                      id="max_age"
                      class="form-control @error('max_age') is-invalid @enderror"
                      value="{{ old('max_age') }}"
                      placeholder="Edad máxima"
                      >

                    @error('max_age')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>

                <div class="row mb-0">
                  <div class="col-md-10 text-right">
                    <a href="{{ route('privileges.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
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
