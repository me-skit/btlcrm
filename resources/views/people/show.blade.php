@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header" id="card-header" data-id="{{ $person->id }}">
      <b><i class="fas fa-address-card"></i> {{ $person->full_name }}</b>
    </div>
    <div class="card-body">

      @include('people.details')

      <div id="privileges" class="mt-1 mb-2">
        @include('privilegehistory.index')
      </div>

      @can('administer')
        <div id="disciplines" class="mt-1 mb-2 ">
          @include('disciplinehistory.index')
        </div>

        @if ($person->membership->baptized)
          <hr>

          <p><b>Agregar Privilegios:</b></p>

          <form action="#">
            <div class="row" id="add-privileges">
              <div class="form-group col-sm-7 col-md-7 col-lg-4">
                <label for="privilege_select">{{ __('Nombre del privilegio') }}<span class="text-danger">*</span></label>
                <select name="privilege_select" id="privilege_select" class="form-control selectpicker show-tick" data-live-search="true" required>
                  <option value="">Seleccione un privilegio...</option>
                  @foreach ($privileges as $privilege)
                    <option value="{{ $privilege->id }}">{{ $privilege->description }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-5 col-md-5 col-lg-3">
                <label for="privilege_start">{{ __('Inicio (opcional)') }}</label>
                <input type="date"
                  name="privilege_start"
                  id="privilege_start"
                  class="form-control @error('privilege_start') is-invalid @enderror"
                  value="{{ old('privilege_start') }}"
                >

                @error('privilege_start')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-5 col-md-5 col-lg-3">
                <label for="privilege_end">{{ __('Fin (opcional)') }}</label>
                <input type="date"
                  name="privilege_end"
                  id="privilege_end"
                  class="form-control @error('privilege_end') is-invalid @enderror"
                  value="{{ old('privilege_end') }}"
                >

                @error('privilege_end')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-7 col-md-7 col-lg-4">
                <label for="privilege_role_id">{{ __('Puesto (opcional)') }}</label>
                <select name="privilege_role_id" id="privilege_role_id" class="form-control selectpicker show-tick" data-live-search="true">
                  <option value="">Sin puesto</option>
                  @foreach ($privilege_roles as $privilege_role)
                    <option value="{{ $privilege_role->id }}">{{ $privilege_role->description }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-12 col-md-12 col-lg-8 text-right">
                <label for="" class="text-white d-none d-lg-block d-xl-block">Boton</label>
                <div>
                  <button class="btn btn-success" id="btn-add-privilege">Agregar</button>
                </div>
              </div>
            </div>
          </form>
      
          <hr>

          <p><b>Agregar Disciplinas:</b></p>

          <form action="#">
            <div class="row">
              <div class="form-group col-sm-7 col-md-7 col-lg-4">
                <label for="discipline_select">{{ __('Tipo') }}<span class="text-danger">*</span></label>
                <select name="discipline_select" id="discipline_select" class="form-control selectpicker show-tick" required>
                  <option value="">Seleccionar tipo...</option>
                  <option value="3">Tres meses</option>
                  <option value="6">Seis meses</option>
                  <option value="0">Tiempo indefinido</option>
                </select>
              </div>

              <div class="form-group col-sm-5 col-md-5 col-lg-3">
                <label for="discipline_start">{{ __('Inicio') }}<span class="text-danger">*</span></label>
                <input type="date"
                  name="discipline_start"
                  id="discipline_start"
                  class="form-control @error('discipline_start') is-invalid @enderror"
                  value="{{ old('discipline_start') }}"
                  required
                >

                @error('discipline_start')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-5 col-md-5 col-lg-3">
                <label for="discipline_end">{{ __('Fin') }}</label>
                <input type="date"
                  name="discipline_end"
                  id="discipline_end"
                  class="form-control @error('discipline_end') is-invalid @enderror"
                  value="{{ old('discipline_end') }}"
                >

                @error('discipline_end')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-4 col-md-3 col-lg-2">
                <label for="act_number">{{ __('No. Acta') }}<span class="text-danger">*</span></label>
                <input type="number" min="1"
                  name="act_number"
                  id="act_number"
                  class="form-control @error('act_number') is-invalid @enderror"
                  value="{{ old('act_number') }}"
                  required
                >

                @error('act_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-3 col-md-4 col-lg-12 text-right">
                <label for="" class="text-white d-none d-sm-block d-md-block d-lg-none">Boton</label>
                <div>
                  <button class="btn btn-success" id="btn-add-discipline">Agregar</button>
                </div>
              </div>
            </div>
          </form>
        @endif
      @endcan
    </div>
  </div>
</div>

<!-- edit privilege modal -->
<div class="modal fade" id="editPrivilegeModal" tabindex="-1" role="dialog" aria-labelledby="editPrivilegeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPrivilegeModalLabel"><b><i class="fas fa-pencil-alt"></i> Editar Privilegio</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editPrivilegeBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-modify-privilege">Modificar</button>
      </div>
    </div>
  </div>
</div>

<!-- edit discipline modal -->
<form action="#">
<div class="modal fade" id="editDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="editDisciplineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDisciplineModalLabel"><b><i class="fas fa-pencil-alt"></i> Editar Disciplina</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editDisciplineBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="btn-modify-discipline">Modificar</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- confirm delete privilege modal -->
<div class="modal fade" id="delPrivilegeModal" tabindex="-1" role="dialog" aria-labelledby="delPrivilegeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delPrivilegeModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Privilegio</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="del-priv-modal">
        Confirme que desea eliminar el registrado de privilegio definitivamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-del-privilege">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete discipline modal -->
<div class="modal fade" id="delDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="delDisciplineModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delDisciplineModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Disciplina</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="del-disp-modal">
        Confirme que desea eliminar el registrado de disciplina definitivamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-del-discipline">Eliminar</button>
      </div>
    </div>
  </div>
</div>
@endsection
