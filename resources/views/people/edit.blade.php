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
            <form action="{{ route('person.update', $person->id) }}" method="POST">
              @csrf
              @method('PATCH')

              @include('people.editpartial')

              <hr>
              <div class="row">
                <div class="col-lg-12 text-right">
                  @if ($person->membership->attend_church)
                    <a href="{{ route('people.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                  @else
                    <a href="{{ route('people.nomembers') }}" class="btn btn-secondary mr-2">Cancelar</a>                      
                  @endif
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