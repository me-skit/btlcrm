<div id="accordion">
  @foreach ($people as $key => $person)
  <div class="card">
    <div class="card-header bg-secondary py-2" id="heading-{{ $person->id }}">
      <h5 class="mb-0 d-flex justify-content-between">
        <button class="btn btn-link text-light collapsed py-0" data-toggle="collapse" data-target="#collapse-{{ $person->id }}" aria-expanded="false" aria-controls="collapse-{{ $person->id }}">
          <i class="far fa-address-card"></i>
          {{ $person->first_name }} {{ $person->second_name }} {{ $person->third_name }} {{ $person->first_surname }} {{ $person->second_surname }}
          {!! $person->role ? "<span class='badge badge-dark'>" . $person->role  . "</span>" : "" !!}
        </button>
      </h5>
    </div>

    <div id="collapse-{{ $person->id }}" class="collapse" aria-labelledby="heading-{{ $person->id }}" data-parent="#accordion">
      <div class="card-body">

        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-5 col-sm-4 col-md-4 col-lg-5 border-bottom">
                Estado privilegio:
              </div>
              <div class="col-7 col-sm-8 col-md-8 col-lg-7">
                <b>
                  @can('administer')
                    {!! $person->disciplined ? "<span class='text-danger'>Susp., Acta No. " . $person->act_number . "</span>" : "Activo" !!}
                  @else
                    {!! $person->disciplined ? "<span class='text-danger'>Suspendido</span>" : "Activo" !!}
                  @endcan
                </b>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-5 col-sm-4 col-md-4 col-lg-5 border-bottom">
                Dirección:
              </div>
              <div class="col-7 col-sm-8 col-md-8 col-lg-7">
                <b>
                  {{ $person->address . ', zona ' . $person->zone }}
                </b>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-5 col-sm-4 col-md-4 col-lg-5 border-bottom">
                Celular:
              </div>
              <div class="col-7 col-sm-8 col-md-8 col-lg-7">
                <b>
                  {{ $person->cellphone }}
                </b>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-5 col-sm-4 col-md-4 col-lg-5 border-bottom">
                Teléfono de casa:
              </div>
              <div class="col-7 col-sm-8 col-md-8 col-lg-7">
                <b>
                  {{ $person->phone_number }}
                </b>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 text-right pt-3">
            @can('consult')
              <a href="{{ route('person.show', $person->id) }}" class="btn btn-primary"><i class="far fa-eye"></i> Detalles</a>
              <a href="{{ route('family.show', $person->family_id) }}" class="btn btn-outline-primary"><i class="fas fa-house-user"></i> Familia</a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>