<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Nombre:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->full_name }}
    </b>
  </div>
</div>

<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Rol familiar:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->family_role }}
    </b>
  </div>
</div>

<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Estado civil:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->civil_status }}
    </b>
  </div>
</div>

<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Sexo:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->sex_decoded }}
    </b>
  </div>
</div>

<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Fecha de nacimiento:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->formatted_birthday }}
    </b>
  </div>
</div>

<div class="row">
  <div class="col-5 col-sm-4 border-bottom">
    Edad:
  </div>
  <div class="col-7 col-sm-8">
    <b>
      {{ $person->age }}
    </b>
  </div>
</div>
