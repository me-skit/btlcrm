@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header" id="card-header" data-id="{{ $person->id }}">
      <b><i class="fas fa-address-card"></i> {{ $person->full_name }}</b>
    </div>
    <div class="card-body">

      @include('people.details')

      <div id="privileges" class="mt-1 mb-2">
        @if ($privs_assigned->count())
          @include('privilegehistory.index')
        @endif
      </div>

      <div id="disciplines" class="mt-1 mb-2 ">
      </div>

      @if ($person->membership->baptized)
      <hr>

        <p><b>Agregar Privilegios:</b></p>

        <div class="row">
          <div class="form-group col-sm-7 col-md-7 col-lg-4">
            <label for="privilege_select">{{ __('Nombre del privilegio') }}<span class="text-danger">*</span></label>
            <select name="privilege_select" id="privilege_select" class="form-control selectpicker show-tick" data-live-search="true" required>
              @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}">{{ $privilege->description }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-sm-5 col-md-5 col-lg-3">
            <label for="privilege_start">{{ __('Inicio (opcional)') }}</label>
            <input type="date"
              name="privilege_start"
              id="privilege_start"
              class="form-control @error('privilege_start') is-invalid @enderror"
              value="{{ old('privilege_start') }}"
            >

            @error('privilege_start')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group col-sm-5 col-md-5 col-lg-3">
            <label for="privilege_end">{{ __('Fin (opcional)') }}</label>
            <input type="date"
              name="privilege_end"
              id="privilege_end"
              class="form-control @error('privilege_end') is-invalid @enderror"
              value="{{ old('privilege_end') }}"
            >

            @error('privilege_end')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group col-sm-7 col-md-7 col-lg-4">
            <label for="privilege_role_id">{{ __('Puesto (opcional)') }}</label>
            <select name="privilege_role_id" id="privilege_role_id" class="form-control selectpicker show-tick" data-live-search="true">
              <option value="">...</option>
              @foreach ($privilege_roles as $privilege_role)
                <option value="{{ $privilege_role->id }}">{{ $privilege_role->description }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-sm-12 col-md-12 col-lg-8 text-right">
            <label for="" class="text-white d-none d-sm-block">Boton</label>
            <div>
              <button class="btn btn-success" id="btn-add-privilege">Agregar</button>
            </div>
          </div>
        </div>
    
        <hr>

        <p><b>Agregar Disciplinas:</b></p>

        <div class="row">
          <div class="form-group col-sm-7 col-md-7 col-lg-4">
            <label for="discipline_list">{{ __('Tipo') }}<span class="text-danger">*</span></label>
            <select name="discipline_list" id="discipline_list" class="form-control selectpicker show-tick" required>
              <option value="3">Tres meses</option>
              <option value="6">Seis meses</option>
              <option value="0">Tiempo indefinido</option>
            </select>
          </div>

          <div class="form-group col-sm-5 col-md-5 col-lg-3">
            <label for="discipline_start">{{ __('Inicio') }}<span class="text-danger">*</span></label>
            <input type="date"
              name="discipline_start"
              id="discipline_start"
              class="form-control @error('discipline_start') is-invalid @enderror"
              value="{{ old('discipline_start') }}"
              required
            >

            @error('discipline_start')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group col-sm-5 col-md-5 col-lg-3">
            <label for="discipline_end">{{ __('Fin') }}</label>
            <input type="date"
              name="discipline_end"
              id="discipline_end"
              class="form-control @error('discipline_end') is-invalid @enderror"
              value="{{ old('discipline_end') }}"
            >

            @error('discipline_end')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group col-sm-7 col-md-7 col-lg-2 text-right">
            <label for="" class="text-white d-none d-sm-block">Boton</label>
            <div>
              <button class="btn btn-success">Agregar</button>
            </div>
          </div>
        </div>
      @endif

    </div>
  </div>
  <div class="mt-2 text-right">
    <a href="{{ route('people.index') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i> Regresar</a>
  </div>
</div>
@endsection
