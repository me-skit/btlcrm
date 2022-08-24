<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Rol familiar:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->family_role }}
        </b>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Estado civil:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->civil_status }}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Sexo:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->sex == 'M' ? "Masculino" : "Femenino" }}
        </b>
      </div>
    </div>
  </div>
</div>            

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Fecha de nacimiento:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ \Carbon\Carbon::parse($person->birthday)->format('d/m/Y')}}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Edad:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          @if ($person->death_date)
            {{ floor((strtotime($person->death_date) -  strtotime($person->birthday)) / 31536000) }}
          @else
            {{ \Carbon\Carbon::parse($person->birthday)->age }}
          @endif
        </b>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Teléfono personal:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->cellphone }}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        e-mail:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->e_mail }}
        </b>
      </div>
    </div>
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
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Aceptado:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->accepted ? "Si" : "No" }}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Fecha que aceptó:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          @if ($person->membership->date_accepted)
            {{ \Carbon\Carbon::parse($person->membership->date_accepted)->format('d/m/Y') }}
          @endif
        </b>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        @if ($person->sex == 'M')
          Bautizado:
        @else
          Bautizada:
        @endif
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->baptized ? "Si" : "No" }}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Fecha de bautizo:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          @if ($person->membership->date_baptized)
            {{ \Carbon\Carbon::parse($person->membership->date_baptized)->format('d/m/Y') }}          
          @endif
        </b>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    @if (!$person->death_date)
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Asiste a la iglesia:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->attendance }}
        </b>
      </div>
    </div>
    @endif
  </div>
  <div class="col-lg-6">
    @if ($person->membership->reason)
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Motivo:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->reason }}
        </b>
      </div>
    </div>
    @endif
  </div>  
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Sede:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->campus_id ? $person->membership->campus->name : "" }}
        </b>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Recibió discipulado:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->discipleship ? "Si" : "No"}}
        </b>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
        Miembro:
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-7">
        <b>
          {{ $person->membership->member == 1 ? "Si" : "No" }}
        </b>
      </div>
    </div>
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