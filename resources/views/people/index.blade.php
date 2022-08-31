@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- the query thing -->
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h2 id="title" data-name="members"><i class="fas fa-users"></i> Miembros</h2>
        <div>
          <a href="{{ route('members.index') }}" class="btn btn-light"><i class="fas fa-redo-alt"></i> Recargar</a>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-7 col-md-5 col-lg-4">
        <div class="input-group">
          <input type="text"
            name="search"
            id="search"
            class="form-control border-right-0 border @error('search') is-invalid @enderror"
            value="{{ old('search') }}"
            autofocus
            >
          <span class="input-group-append">
            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
          </span>
        </div>
      </div>
    </div>

    <div id="pagination">
      @include('people.pagination')
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" id="modal-content">

    </div>
  </div>
</div>

@endsection