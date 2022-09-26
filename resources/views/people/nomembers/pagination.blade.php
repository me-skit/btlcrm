<div class="row justify-content-center d-print-none">
  <div class="col-md-12 offset-md-1">
    {{ $people->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center d-none d-print-block">
  <div class="col-md-12">{{ 'Página ' . $people->currentPage() . ' de ' . $people->lastPage() . '.' }}</div>
  <br>
</div>

<div class="row justify-content-center">
  <div class="col-md-12">
    <table class="table table-sm table-hover table-responsive-lg">
      <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Nombre</th>
            <th>Acept.</th>
            <th>Baut.</th>
            <th>Religión</th>
            <th class="text-center">Edad</th>
            <th class="text-center">EC</th>
            <th class="text-center">Enf.</th>
            <th class="text-center">Disc.</th>
            <th class="d-print-none">Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td class="align-middle text-center">{{ ($people->currentPage() - 1) * $people->perPage() + $key + 1 }}</td>
          <td class="align-middle text-truncate">{{ $person->full_name }} </td>
          <td class="align-middle">{{ $person->accepted ? "Si" : "No" }}</td>
          <td class="align-middle">{{ $person->baptized ? "Si" : "No" }}</td>
          <td class="align-middle">{{ $person->religion }}</td>
          <td class="align-middle text-center">{{ $person->age }}</td>
          <td class="align-middle text-center">{{ $person->civil_status }}</td>
          <td class="align-middle text-center text-truncate">{{ $person->diseases ? implode(",", $person->diseases) : '' }}</td>
          <td class="align-middle text-center text-truncate">{{ $person->handicaps ? implode(",", $person->handicaps) : '' }}</td>
          <td class="align-middle d-print-none">
            <div class="d-flex">
              <button type="button"
                class="btn btn-sm btn-secondary mr-3 btn-f-details text-truncate"
                data-toggle="modal"
                data-target="#detailsModal"
                data-id="{{ $person->id }}">
                  <i class="far fa-eye"></i><span class="d-none d-lg-inline"> Detalles</span>
                </button>

              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-sm btn-primary mr-3 text-truncate"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
              <a href="{{ route('family.show', $person->family()->id ) }}" class="btn btn-sm btn-outline-primary text-truncate"><i class="fas fa-house-user"></i><span class="d-none d-lg-inline"> Familia</span></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>