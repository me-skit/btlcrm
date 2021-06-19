@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header" id="card-header">
        <b><i class="fas fa-address-card"></i> {{ $person->full_name }}</b>
      </div>
      <div class="card-body">

        @include('people.show.info')

      </div>
    </div>
  </div>

  @include('people.show.modals')
@endsection
