<div class="modal-header">
  <h5 class="modal-title" id="detailsModalLabel">
    <b>
      <i class="fas fa-address-card"></i> {{ $person->full_name }}
    </b>
  </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-lg-6">
      Rol familiar:
      <b>
        {{ $person->family_role }}
      </b>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      Estado civil:
      <b>
        {{ $person->civil_status }}
      </b>
    </div>
    <div class="col-lg-6">
      Sexo:
      <b>
        {{ $person->sex_decoded }}
      </b>
    </div>
  </div>            
  
  <div class="row">
    <div class="col-lg-6">
      Fecha de nacimiento:
      <b>
        {{ $person->birthday }}
      </b>
    </div>
    <div class="col-lg-6">
      Edad:
      <b>
        {{ $person->age }}
      </b>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      Teléfono personal:
      <b>
        {{ $person->cellphone }}
      </b>
    </div>
    <div class="col-lg-6">
      e-mail:
      <b>
        {{ $person->e_mail }}
      </b>
    </div>        
  </div>
  
  @if ($person->diseases)
    <div class="row">
      <div class="col-lg-12">
        Enfermedades:
        @foreach($person->diseases as $disease)
          <h5 class="d-inline">
            <span class="badge badge-danger font-weight-normal">
              {{ $disease }}
            </span>
          </h5>
        @endforeach
      </div>
    </div>
  @endif
  
  @if($person->handicaps)
    <div class="row">
      <div class="col-lg-12">
        Discapacidades:
        @foreach($person->handicaps as $handicap)
          <h5 class="d-inline">
            <span class="badge badge-danger font-weight-normal">
              {{ $handicap }}
            </span>
          </h5>
        @endforeach
      </div>
    </div>
  @endif
  
  <hr>
  
  <div class="row">
    <div class="col-lg-6">
      Aceptado:
      <b>
        {!! $person->membership->accepted ? "Si" : "<span class='text-danger'>No</span>" !!}
      </b>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      @if ($person->sex == 'M')
        Bautizado:
      @else
        Bautizada:
      @endif
      <b>
        {!! $person->membership->baptized ? "Si" : "<span class='text-danger'>No</span>" !!}
      </b>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      Miembro de Iglesia Bethel:
      <b>
        {{ $person->member }}
      </b>
    </div>
  </div>
  
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>