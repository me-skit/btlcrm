@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- the query thing -->
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2 id="title" data-name="nomembers">No Miembros</h2>
        <div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-5 col-md-4 col-lg-3 offset-md-1">
        <input type="text"
          name="search"
          id="search"
          class="form-control @error('search') is-invalid @enderror"
          value="{{ old('search') }}"
          autofocus
        >
      </div>
    </div>     

    <div id="pagination">
      @include('people.nomembers.pagination')
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" id="modal-content">

      </div>
    </div>
  </div>  
@endsection