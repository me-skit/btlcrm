@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Datos de Familia</span>
          </div>

          <div class="card-body">
            <form action="{{ route('family.store') }}" method="POST">
              @csrf

              <div class="row form-group">
                <label for="village_id" class="col-md-3 col-form-label text-md-right">{{ __('Ubicación') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="village_id" class="form-control" autofocus>
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <label for="union_type" class="col-md-3 col-form-label text-md-right">{{ __('Tipo de Unión') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="union_type" class="form-control">
                    <option value="1">Casados</option>
                    <option value="2">Unidos</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
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

              <div class="form-group row">
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

              <div class="form-group row">
                <label for="phone_nomber" class="col-md-3 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="phone_nomber"
                    id="phone_nomber"
                    class="form-control @error('phone_nomber') is-invalid @enderror"
                    value="{{ old('phone_nomber') }}"
                  >

                  @error('phone_nomber')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>              

              <div class="row form-group">
                <label for="longitude" class="col-md-3 col-form-label text-md-right">{{ __('Longitud') }}</label>
                <div class="col-md-7">
                  <input type="number"
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
                  <input type="number"
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
                  <a href="{{ route('families.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
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