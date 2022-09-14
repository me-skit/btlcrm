@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2><i class="fas fa-user-tie"></i> Nómina de Privilegios ({{ date("Y") }})</h2>
      </div>
    </div>

    @if (isset($privileges))
      <div class="row justify-content-center">
        <div class="form-group col-md-10">
          <div class="row" id="directory">
            <label for="privilege_list" class="col-md-1 pt-2">{{ __('Privilegio: ') }}</label>
            <select name="privilege_list" id="privilege_list" class="selectpicker show-tick col-sm-8 col-md-6 col-lg-4" data-live-search="true" required>
              @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}" {{ $privilege->id === $selected->id ? 'selected' : '' }}>{{ $privilege->name }}</option>                    
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-10">
          <div id="accordion">
            @include('privilegehistory.cards')
          </div>
        </div>
      </div>
    @else
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <p>No hay privilegios que mostrar</p>
        </div>
      </div>
    @endif
  </div>
@endsection