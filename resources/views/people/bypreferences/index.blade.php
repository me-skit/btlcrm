@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h3 id="title" data-name="{{ $address }}"><i class="fas fa-users"></i> Por Preferencias</h3>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="form-group col-md-12">
        <div class="row" id="preferences">
          <label for="privilege_list" class="col-md-1 pt-2">{{ __('Privilegio: ') }}</label>
          <select name="privilege_list" id="privilege_list" class="selectpicker show-tick col-sm-8 col-md-6 col-lg-4" data-live-search="true" data-path="members/bypreferences" required>
            @foreach ($privileges as $privilege)
              <option value="{{ $privilege->id }}">{{ $privilege->name }}</option>                    
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div id="pagination">
      @include('people.pagination')
    </div>
  </div>
@endsection