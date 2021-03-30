<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $people->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-hover table-responsive-md table-responsive-lg">
      <thead>
          <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Aceptado</th>
            <th>Bautizado</th>
            <th>Asiste</th>
            <th class="d-none d-md-block">Sede</th>
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td>{{ ($people->currentPage() - 1) * 7 + $key + 1 }}</td>
          <td>
            {{ $person->first_name . " " . $person->second_name . " " . $person->third_name . " " . $person->first_surname . " " . $person->second_surname }} 
            {!! $person->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
          </td>
          <td>{{ $person->membership->accepted ? "Si" : "No" }}</td>
          <td>{{ $person->membership->baptized ? "Si" : "No" }}</td>
          <td>
            @if (!$person->death_date)
              {{ $person->membership->attend_church ? ($person->membership->attend_church == 1 ? "Si" : "Otra iglesia") : "No" }}
            @endif
          </td>
          <td class="d-none d-md-block">{{ $person->membership->campus_id ? $person->membership->campus->name : "" }}</td>
          <td>
            <div class="d-flex">
              <button type="button"
                class="btn btn-secondary mr-3 btn-p-details"
                data-toggle="modal"
                data-target="#detailsModal"
                data-id="{{ $person->id }}">
                Detalles
              </button>
              {{-- <a href="{{ route('person.show', $person->id ) }}" class="btn btn-secondary mr-3">Detalles</a> --}}
              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-primary mr-3">Editar</a>
              <a href="{{ route('family.show', $person->family()->id ) }}" class="btn btn-link mr-3">Familia</a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>
