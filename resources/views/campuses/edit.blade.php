@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold">Editar Sede</span>
          </div>

          <div class="card-body">
            <form action="{{ route('campus.update', $campus->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="row form-group">
                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <input type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') ?? $campus->name }}"
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
                        <option value="{{ $village->id }}" {{ $village->id == $campus->village_id ? 'selected' : '' }}>{{ $village->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>              

              <div class="row form-group">
                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}</label>
                <div class="col-md-7">
                  <input type="text"
                    name="address"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address') ?? $campus->address }}"
                    >

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <label for="longitude" class="col-md-3 col-form-label text-md-right">{{ __('Longitud') }}</label>
                <div class="col-md-7">
                  <input type="number" step="any"
                    name="longitude"
                    id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror"
                    value="{{ old('longitude') ?? $campus->longitude }}"
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
                  <input type="number" step="any"
                    name="latitude"
                    id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror"
                    value="{{ old('latitude') ?? $campus->latitude }}"
                    >

                  @error('latitude')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-10 text-right">
                  <a href="{{ route('campus.index') }}" class="btn btn-secondary mr-1">Cancelar</a>
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
