@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h2><i class="fas fa-user-tie"></i> Nomina de Privilegios</h2>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-12">
        <div class="row">
          <label for="privilege_list" class="col-md-1 pt-2">{{ __('Cargo: ') }}</label>
          <select name="privilege_list" id="privilege_list" class="selectpicker show-tick col-sm-8 col-md-6 col-lg-4" data-live-search="true" required>
            @foreach ($privileges as $privilege)
              <option value="{{ $privilege->id }}" {{ $privilege->id === $selected->id ? 'selected' : '' }}>{{ $privilege->description }}</option>                    
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="table table-hover table-responsive-md">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nombre</th>
              <th>Puesto</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="priv-t-body">
            @include('privilegehistory.tablebody')
          </tbody>
        </table>   
      </div>
    </div>    
  </div>
@endsection