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
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td>{{ ($people->currentPage() - 1) * 7 +$key + 1 }}</td>
          <td>
            {{ $person->full_name }} 
            {!! $person->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
          </td>
          <td>{{ $person->accepted ? "Si" : "No" }}</td>
          <td>{{ $person->baptized ? "Si" : "No" }}</td>
          <td>
            @if (!$person->death_date)
              {{ $person->attend_church ? ($person->attend_church == 1 ? "Si" : "Otra iglesia") : "No" }}
            @endif
          </td>
          <td>
            <div class="d-flex">
              <button type="button"
                class="btn btn-secondary mr-3 btn-p-details"
                data-toggle="modal"
                data-target="#detailsModal"
                data-id="{{ $person->id }}">
                  <i class="far fa-eye"></i> Detalles
                </button>

              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-primary mr-3"><i class="fas fa-pencil-alt"></i> Editar</a>
              <a href="{{ route('family.show', $person->family()->id ) . '?back=nomembers' }}" class="btn btn-link"><i class="fas fa-house-user"></i> Familia</a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>