@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2><i class="fas fa-user-tie"></i> Nomina de Privilegios ({{ date("Y") }})</h2>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="form-group col-md-10">
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
      <div class="col-md-10">
        <div id="accordion">
          @include('privilegehistory.cards')
        </div>
      </div>
    </div>
  </div>
@endsection