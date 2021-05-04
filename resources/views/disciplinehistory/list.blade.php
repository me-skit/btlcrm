@if ($active->count())
<div class="row justify-content-center">
  <div class="col-md-10 d-flex justify-content-between align-items-baseline">
    <h2><i class="fas fa-user-lock fa-fw"></i> Disciplinas Activas</h2>
  </div>
</div>

<div class="row justify-content-center mb-3">
  <div class="col-md-10">
    <ul class="list-group">
      @foreach ($active as $person)
        <li class="list-group-item py-2">
          <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-3">
              {{ \Carbon\Carbon::parse($person->start_date)->format('d/m/y') }} -

              @if ($person->end_date)
                {{ \Carbon\Carbon::parse($person->end_date)->format('d/m/y') }}                     
              @else
                indefinido
              @endif
            </div>
            <div class="col-md-3 col-lg-3">
              @if ($person->discipline_type === 3)
                Tres meses
              @elseif ($person->discipline_type == 6)
                Seis meses
              @else
                Sin tiempo
              @endif
              (Acta No. {{ $person->act_number }})
            </div>
            <div class="col-sm-12 col-md-5 col-lg-3">
              {{ $person->first_name }} {{ $person->second_name }} {{ $person->third_name }} {{ $person->first_surname }} {{ $person->second_surname }}
            </div>
            <div class="d-flex justify-content-end col-12 col-sm-12 col-md-12 col-lg-3 text-right">
              <a href="#" class="btn btn-warning btn-sm"
                data-toggle="modal" data-target="#confirmModal"
                name="end-discipline"
                data-type="1"
                data-id="{{ $person->discipline_id }}"
                data-date="{{ $person->end_date }}">
                <i class="fas fa-file-archive"></i> Finalizar
              </a>
              <a href="{{ route('person.show', $person->person_id) }}" class="btn btn-primary btn-sm ml-1"><i class="far fa-eye"></i> Mas info</a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@endif

@if ($expired->count())
<div class="row justify-content-center">
  <div class="col-md-10 d-flex justify-content-between align-items-baseline">
    <h2><i class="fas fa-user-check"></i> Disciplinas Expiradas</h2>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <ul class="list-group">
      @foreach ($expired as $person)
        <li class="list-group-item py-2">
          <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-3">
              {{ \Carbon\Carbon::parse($person->start_date)->format('d/m/y') }} -

              @if ($person->end_date)
                {{ \Carbon\Carbon::parse($person->end_date)->format('d/m/y') }}                     
              @else
                indefinido
              @endif
            </div>
            <div class="col-md-3 col-lg-3">
              @if ($person->discipline_type === 3)
                Tres meses
              @elseif ($person->discipline_type === 6)
                Seis meses
              @else
                Sin tiempo
              @endif
              (Acta No. {{ $person->act_number }})
            </div>
            <div class="col-sm-12 col-md-5 col-lg-3">
              {{ $person->first_name }} {{ $person->second_name }} {{ $person->third_name }} {{ $person->first_surname }} {{ $person->second_surname }}
            </div>
            <div class="d-flex justify-content-end col-12 col-sm-12 col-md-12 col-lg-3 text-right">
              <a href="#" class="btn btn-warning btn-sm"
                data-toggle="modal" data-target="#confirmModal"
                name="end-discipline"
                data-type="0"
                data-id="{{ $person->discipline_id }}"
                data-date="{{ $person->end_date }}">
                <i class="fas fa-file-archive"></i> Finalizar
              </a>
              <a href="{{ route('person.show', $person->person_id) }}" class="btn btn-primary btn-sm ml-1"><i class="far fa-eye"></i> Mas info</a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@endif