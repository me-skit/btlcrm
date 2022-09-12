<div class="row justify-content-center d-print-none">
  <div class="col-md-10 offset-md-1">
    {{ $people->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-sm table-hover table-responsive-md">
      <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Nombre</th>
            <th>Acept.</th>
            <th>Baut.</th>
            <th>Religión</th>
            <th class="d-print-none">Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td class="align-middle text-center">{{ ($people->currentPage() - 1) * 7 +$key + 1 }}</td>
          <td class="align-middle text-truncate">
            {{ $person->full_name }} 
          </td>
          <td class="align-middle">{{ $person->accepted ? "Si" : "No" }}</td>
          <td class="align-middle">{{ $person->baptized ? "Si" : "No" }}</td>
          <td class="align-middle">
            {{ $person->religion }}
          </td>
          <td class="align-middle d-print-none">
            <div class="d-flex">
              <button type="button"
                class="btn btn-sm btn-secondary mr-3 btn-f-details"
                data-toggle="modal"
                data-target="#detailsModal"
                data-id="{{ $person->id }}">
                  <i class="far fa-eye"></i><span class="d-none d-lg-inline"> Detalles</span>
                </button>

              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-sm btn-primary mr-3"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
              <a href="{{ route('family.show', $person->family()->id ) . '?back=nomembers' }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-house-user"></i><span class="d-none d-lg-inline"> Familia</span></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>