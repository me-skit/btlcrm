@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-house-user"></i> Datos de Familia</span>
          </div>

          <div class="card-body">
            <form action="{{ route('family.store') . '?back=families' }}" method="POST">
              @csrf

              <div class="row form-group">
                <label for="village_id" class="col-md-3 col-form-label text-md-right">{{ __('Ubicación') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="village_id" class="form-control" autofocus required>
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="union_type" class="col-md-3 col-form-label text-md-right">{{ __('Tipo de Unión') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="union_type" class="form-control" required>
                    <option value="1">Casados</option>
                    <option value="2">Unidos</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="family_name" class="col-md-3 col-form-label text-md-right">{{ __('Apellidos de Familia') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <input type="text"
                    name="family_name"
                    id="family_name"
                    class="form-control @error('family_name') is-invalid @enderror"
                    value="{{ old('family_name') }}"
                    required
                  >

                  @error('family_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <input type="text"
                    name="address"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') }}"
                    required
                  >

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>              

              <div class="row form-group">
                <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="phone_number"
                    id="phone_number"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    value="{{ old('phone_number') }}"
                  >

                  @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>              

              <div class="row form-group">
                <label for="longitude" class="col-md-3 col-form-label text-md-right">{{ __('Longitud') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="longitude"
                    id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror"
                    value="{{ old('longitude') }}"
                  >

                  @error('longitude')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="latitude" class="col-md-3 col-form-label text-md-right">{{ __('Latitud') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="latitude"
                    id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror"
                    value="{{ old('latitude') }}"
                  >

                  @error('latitude')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-0">
                <div class="col-md-7 offset-md-3 text-right">
                  <a href="{{ route('families.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection