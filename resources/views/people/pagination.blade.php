<div class="row">
  <div class="col-md-12">
    {{ $people->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-12">
    <table class="table table-sm table-hover table-responsive-md">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Nombre</th>
          <th>Acept.</th>
          <th>Baut.</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td class="align-middle text-center">{{ ($people->currentPage() - 1) * 7 + $key + 1 }}</td>
          <td class="align-middle text-truncate">
            {{ $person->full_name }} 
          </td>
          <td class="align-middle">{{ $person->accepted ? "Si" : "No" }}</td>
          <td class="align-middle">{{ $person->baptized ? "Si" : "No" }}</td>
          <td class="align-middle">
            <div class="d-flex">
              <a href="{{ route('person.show', $person->id ) }}" class="btn btn-secondary mr-3"><i class="far fa-eye"></i><span class="d-none d-xl-inline"> Detalles</span></a>
              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-primary mr-3"><i class="fas fa-pencil-alt"></i><span class="d-none d-xl-inline"> Editar</span></a>
              <a href="{{ route('family.show', $person->family()->id ) . '?back=members' }}" class="btn btn-outline-primary mr-3"><i class="fas fa-house-user"></i><span class="d-none d-xl-inline"> Familia</span></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>
