@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-user-plus"></i> Agregar Miembro</span>
          </div>
          <div class="card-body">
            <div id="family_names" data-first="{{ $family->family_names[0] ?? '' }}" data-second="{{ $family->family_names[1] ?? '' }}"></div>
            <form action="{{ route('family.addmember', $family->id) }}" method="POST">
              @csrf

              @include('families.members.createpartial')

              <hr>
              <div class="row">
                <div class="col-lg-12 text-right">
                  <a href="{{ route('family.show', $family->id) }}" class="btn btn-secondary mr-2">Cancelar</a>
                  <button class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
