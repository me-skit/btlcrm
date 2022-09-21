<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $families->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-sm table-hover table-responsive-md">
      <thead>
          <tr>
              <th class="text-center">No.</th>
              <th>Apellidos</th>
              <th class="text-center">Zona</th>
              <th>Dirección</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($families as $key => $family)
          <tr>
            <td class="align-middle text-center">{{ ($families->currentPage() - 1) * $families->perPage() + $key + 1 }}</td>
            <td class="align-middle text-truncate">{{ $family->family_name }}</td>
            <td class="align-middle text-center">{{ $family->zone }}</td>
            <td class="align-middle text-truncate">{{ $family->address }}</td>
            <td class="align-middle">
              <div class="d-flex">
                <a href="{{ route('family.show', $family->id ) . '?back=families' }}" class="btn btn-sm btn-primary mr-3"><i class="far fa-eye"></i><span class="d-none d-lg-inline"> Detalles</span></a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>   
  </div>
</div>