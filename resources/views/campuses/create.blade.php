@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-place-of-worship"></i> Agregar Nueva Sede</span>
          </div>

          <div class="card-body">
            <form action="{{ route('campus.store') }}" method="post">
              @csrf

              <div class="row form-group">
                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <input type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Nombre de sede"
                    required
                    autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="village_id" class="col-md-3 col-form-label text-md-right">{{ __('Poblado') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="village_id" class="form-control" required>
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="address"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') }}"
                    placeholder="Dirección de sede"
                    >

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="phone_number"
                    id="phone_number"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    value="{{ old('phone_number') }}"
                    placeholder="Número de teléfono"
                  >
    
                  @error('phone_nomber')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="location" class="col-md-3 col-form-label text-md-right">{{ __('Long, Lat') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="location"
                    id="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location') }}"
                    placeholder="Latitud, longitud"
                  >

                  @error('location')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-10 text-right">
                  <a href="{{ route('campus.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
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