@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-home"></i> Editar Datos de Familia</span>
          </div>

          <div class="card-body">
            {{-- <form action="{{ route('family.update', $family->id) . '?back=' . $back }}" method="POST"> --}}
            <form action="{{ route('family.update', $family->id) }}" method="POST">
              @csrf
              @method('PATCH')
            
              <div class="row form-group">
                <label for="village_id" class="col-md-3 col-form-label text-md-right">{{ __('Ubicación') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="village_id" class="form-control" autofocus>
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}" {{ $family->village_id == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            
              <div class="row form-group">
                <label for="union_type" class="col-md-3 col-form-label text-md-right">{{ __('Situación marital') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="union_type" class="form-control">
                    <option value="1" {{ $family->union_type == 1 ? 'selected' : '' }}>Casados</option>
                    <option value="2" {{ $family->union_type == 2 ? 'selected' : '' }}>Unidos</option>
                    <option value="3" {{ $family->union_type == 3 ? 'selected' : '' }}>Divorciados</option>
                    <option value="4" {{ $family->union_type == 4 ? 'selected' : '' }}>Separados</option>
            
                  </select>
                </div>
              </div>
            
              <div class="form-group row">
                <label for="family_name" class="col-md-3 col-form-label text-md-right">{{ __('Apellidos') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <input type="text"
                    name="family_name"
                    id="family_name"
                    class="form-control @error('family_name') is-invalid @enderror"
                    value="{{ old('family_name') ?? $family->family_name }}"
                    placeholder="Apellidos"
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
                    value="{{ old('address') ?? $family->address }}"
                    placeholder="Dirección"
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
                    value="{{ old('phone_number') ?? $family->phone_number }}"
                    placeholder="Teléfono recidencial"
                  >
            
                  @error('phone_nomber')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            
              <div class="row form-group">
                <label for="location" class="col-md-3 col-form-label text-md-right">{{ __('Lat, Long') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="location"
                    id="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location') ?? $family->location }}"
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
                  <a href="{{ route('family.show', $family->id) }}" class="btn btn-secondary mr-1">Cancelar</a>
                  <button class="btn btn-primary">Modificar</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div id="map" class="mt-3" data-map="2" data-lat="{{ $family->latitude }}" data-lng="{{ $family->longitude }}"></div>
      </div>
    </div>
  </div>

  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8j13SI1rqi2uNJ1OpHbE20zdMEaG8d9I&callback=initMap&libraries=&v=weekly"
    async
  >
  </script>  
@endsection
