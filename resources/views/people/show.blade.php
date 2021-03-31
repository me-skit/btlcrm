<div class="modal-header">
  <h5 class="modal-title" id="detailsModalLabel">
    <b>
      {{ $person->first_name . " " . $person->second_name . " " . $person->third_name . " " . $person->first_surname . " " . $person->second_surname }}
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
        {{ $family->pivot->family_role == 1 ? "Padre" : ($family->pivot->family_role == 2 ? "Madre" : ($family->pivot->family_role == 3 ? "Hijo" : "Hija")) }}
      </b>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      Estado civil:
      <b>
        @if ($person->sex == 'M')
          {{ $person->status == 1 ? "Casado" : ($person->status == 2 ? "Soltero" : "Unido") }}
        @else
          {{ $person->status == 1 ? "Casada" : ($person->status == 2 ? "Soltera" : "Unida") }}
        @endif
      </b>
    </div>
    <div class="col-lg-6">
      Sexo:
      <b>
        {{ $person->sex == 'M' ? "Masculino" : "Femenino" }}
      </b>
    </div>
  </div>            
  
  <div class="row">
    <div class="col-lg-6">
      Fecha de nacimiento:
      <b>
        {{ \Carbon\Carbon::parse($person->birthday)->format('d/m/Y')}}
      </b>
    </div>
    <div class="col-lg-6">
      Edad:
      <b>
        @if ($person->death_date)
          {{ floor((strtotime($person->death_date) -  strtotime($person->birthday)) / 31536000) }}
        @else
          {{ \Carbon\Carbon::parse($person->birthday)->age }}
        @endif
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
    <div class="col-lg-6">
      Fecha que aceptó:
      <b>
        {{ $person->membership->date_accepted }}
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
    <div class="col-lg-6">
      Fecha de bautizo:
      <b>
        {{ $person->membership->date_accepted }}
      </b>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      @if (!$person->death_date)
      Asiste a la iglesia:
        <b>
          {!! $person->membership->attend_church ? ($person->membership->attend_church == 1 ? "Si" : "Asiste a otra iglesia") : "<span class='font-weight-bold'>No</span>" !!}
        </b>
      @endif
    </div>
    <div class="col-lg-6">
      Cede:
      <b>
        {{ $person->membership->campus_id ? $person->membership->campus->name : "" }}
      </b>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      Recibió discipulado:
      <b>
        {{ $person->membership->discipleship ? "Si" : "No"}}
      </b>
    </div>
    <div class="col-lg-6">
    </div>
  </div>
  
  @if ($person->preferences and !$person->death_date)
    <div class="row">
      <div class="col-lg-12">
        Privilegios preferidos:
        @foreach($person->preferences as $preference)
          <h5 class="d-inline">
            <span class="badge badge-warning font-weight-normal">
              {{ $preference }}
            </span>
          </h5>
        @endforeach
      </div>
    </div>
  @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>