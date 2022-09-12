@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- the query thing -->
    <div class="row justify-content-center mb-3">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h3 id="title" data-name="{{ $address }}"><i class="fas fa-users"></i> {{ $title }}</h3>
        <div class="d-print-none">
          <a href="{{ url($address) }}" class="btn btn-light"><i class="fas fa-redo-alt"></i><span class="d-none d-lg-inline"> Recargar</span></a>
          <a id="btn-print" href="#" class="btn btn-light"><i class="fas fa-print"></i><span class="d-none d-lg-inline"> Imprimir</span></a>
          {{-- <a href="{{ route('members.index') }}" class="btn btn-light"><i class="fas fa-redo-alt"></i> Recargar</a> --}}
        </div>
      </div>
    </div>

    <div class="row justify-content-center d-print-none">
      <div class="col-md-10">
        <div class="row form-group">
          <div class="col-sm-8 col-md-7 col-lg-5">
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