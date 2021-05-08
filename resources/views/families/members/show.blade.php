<div class="row">
  <div class="col-lg-6">
    Rol familiar:
    <b>
      {{ $member->pivot->family_role == 1 ? "Padre" : ($member->pivot->family_role == 2 ? "Madre" : ($member->pivot->family_role == 3 ? "Hijo" : "Hija")) }}
    </b>
  </div>
  <div class="col-lg-6">
    No. DPI:
    <b>
      {{ $member->dpi }}
    </b>
  </div>  
</div>

<div class="row">
  <div class="col-lg-6">
    Estado civil:
    <b>
      {{ $member->civil_status }}
    </b>
  </div>
  <div class="col-lg-6">
    Sexo:
    <b>
      {{ $member->sex == 'M' ? "Masculino" : "Femenino" }}
    </b>
  </div>
</div>            

<div class="row">
  <div class="col-lg-6">
    Fecha de nacimiento:
    <b>
      {{ \Carbon\Carbon::parse($member->birthday)->format('d/m/Y')}}
    </b>
  </div>
  <div class="col-lg-6">
    Edad:
    <b>
      @if ($member->death_date)
        {{ floor((strtotime($member->death_date) -  strtotime($member->birthday)) / 31536000) }}
      @else
        {{ \Carbon\Carbon::parse($member->birthday)->age }}
      @endif
    </b>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    Teléfono personal:
    <b>
      {{ $member->cellphone }}
    </b>
  </div>
  <div class="col-lg-6">
    e-mail:
    <b>
      {{ $member->e_mail }}
    </b>
  </div>        
</div>

@if ($member->diseases)
  <div class="row">
    <div class="col-lg-12">
      Enfermedades:
      @foreach($member->diseases as $disease)
        <h5 class="d-inline">
          <span class="badge badge-danger font-weight-normal">
            {{ $disease }}
          </span>
        </h5>
      @endforeach
    </div>
  </div>
@endif

@if($member->handicaps)
  <div class="row">
    <div class="col-lg-12">
      Discapacidades:
      @foreach($member->handicaps as $handicap)
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
      {!! $member->membership->accepted ? "Si" : "<span class='text-danger'>No</span>" !!}
    </b>
  </div>
  <div class="col-lg-6">
    Fecha que aceptó:
    <b>
      @if ($member->membership->date_accepted)
        {{ \Carbon\Carbon::parse($member->membership->date_accepted)->format('d/m/Y') }}          
      @endif
    </b>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    @if ($member->sex == 'M')
      Bautizado:
    @else
      Bautizada:
    @endif
    <b>
      {!! $member->membership->baptized ? "Si" : "<span class='text-danger'>No</span>" !!}
    </b>
  </div>
  <div class="col-lg-6">
    Fecha de bautizo:
    <b>
      @if ($member->membership->date_baptized)
        {{ \Carbon\Carbon::parse($member->membership->date_baptized)->format('d/m/Y') }}          
      @endif
    </b>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    @if (!$member->death_date)
    Asiste a la iglesia:
      <b>
        {{ $member->membership->attendance }}
      </b>
    @endif
  </div>
  <div class="col-lg-6">
    @if ($member->membership->reason)
    Motivo:
      <b>
        {{ $member->membership->reason }}
      </b>
    @endif
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    Cede:
    <b>
      {{ $member->membership->campus_id ? $member->membership->campus->name : "" }}
    </b>
  </div>
  <div class="col-lg-6">
    Recibió discipulado:
    <b>
      {{ $member->membership->discipleship ? "Si" : "No"}}
    </b>
  </div>
</div>

@if ($member->preferences and !$member->death_date)
  <div class="row">
    <div class="col-lg-12">
      Privilegios preferidos:
      @foreach($member->preferences as $preference)
        <h5 class="d-inline">
          <span class="badge badge-warning font-weight-normal">
            {{ $preference }}
          </span>
        </h5>
      @endforeach
    </div>
  </div>
@endif        