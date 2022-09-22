<div class="row d-print-none">
  <div class="col-md-10 offset-md-1">
    {{ $privilegeRoles->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-sm table-hover table-responsive-md">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Descripción</th>
          <th class="d-print-none">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($privilegeRoles as $key => $privilegeRole)
          <tr>
            <td class="align-middle text-center">{{ ($privilegeRoles->currentPage() - 1) * $privilegeRoles->perPage() + $key + 1 }}</td>
            <td class="align-middle text-truncate">{{ $privilegeRole->name }}</td>
            <td class="align-middle d-print-none">
              <div class="d-flex">
                <a href="{{ route('privilegerole.edit', $privilegeRole->id) }}" class="btn btn-sm btn-primary mr-3"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>

                <form action="{{ route('privilegerole.destroy', $privilegeRole->id) }}" method="post">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i><span class="d-none d-lg-inline"> Eliminar</span></button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>