@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-user-tie"></i> Editar Privilegio</span>
          </div>

          <div class="card-body">
            <form action="{{ route('privilege.update', $privilege->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}<span class="text-danger">*</span></label>

                <div class="col-md-6">
                  <input type="text"
                    name="description"
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description') ?? $privilege->description }}"
                    placeholder="Nombre del privilegio"
                    required
                    autofocus>

                  @error('description')
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
                    <option value {{ $privilege->preferred_sex ? '' : 'selected' }} >Ambos sexos</option>
                    <option value="M" {{ $privilege->preferred_sex == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ $privilege->preferred_sex == 'F' ? 'selected' : '' }}>Femenino</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="preferred_status" class="col-md-4 col-form-label text-md-right">{{ __('Estado civil') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <select name="preferred_status" class="form-control">
                    <option value {{ $privilege->preferred_status ? '' : 'selected' }}>Cualquier estado civil</option>
                    <option value="1" {{ $privilege->preferred_status == 1 ? 'selected' : '' }}>Casado(a)</option>
                    <option value="2" {{ $privilege->preferred_status == 2 ? 'selected' : '' }}>Soltero(a)</option>
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
                      value="{{ old('min_age') ?? $privilege->min_age }}"
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
                      value="{{ old('max_age') ?? $privilege->max_age }}"
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
                  <button class="btn btn-primary">Modificar</button>
                </div>
              </div>
            </form>          
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
