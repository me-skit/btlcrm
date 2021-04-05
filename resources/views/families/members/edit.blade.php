@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <span class="font-weight-bold"><i class="fas fa-user-edit"></i> Editar Datos de Persona</span>
          </div>
          <div class="card-body">
            <form action="{{ route('family.updatemember', [$family->id, $person->id]) . '?back=' . $back }}" method="POST">
              @csrf
              @method('PATCH')

              @include('families.members.editpartial')

              <hr>
              <div class="row">
                <div class="col-lg-12 text-right">
                  <a href="{{ route('family.show', $family->id) . '?back=' . $back }}" class="btn btn-secondary mr-2">Cancelar</a>
                  <button class="btn btn-primary">Modificar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
