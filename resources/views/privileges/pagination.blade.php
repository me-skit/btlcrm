<div class="row d-print-none">
  <div class="col-md-10 offset-md-1">
    {{ $privileges->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center d-none d-print-block">
  <div class="col-md-10 offset-md-1">
    {{ 'Página ' . $privileges->currentPage() . ' de ' . $privileges->lastPage() . '.' }}
  </div>
  <br>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-sm table-hover table-responsive-md">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Nombre</th>
          <th>Preferencias</th>
          <th class="d-print-none">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($privileges as $key => $privilege)
          <tr>
            <td class="align-middle text-center">{{ ($privileges->currentPage() - 1) * $privileges->perPage() + $key + 1 }}</td>
            <td class="align-middle">{{ $privilege->name }}</td>
            <td class="align-middle">{{ $privilege->preferrences }}</td>
            <td class="align-middle d-print-none">
              <div class="d-flex">
                <a href="{{ route('privilege.edit', $privilege->id) }}" class="btn btn-sm btn-primary mr-3 text-truncate"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
                
                <form action="{{ route('privilege.destroy', $privilege->id) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-sm btn-danger text-truncate"><i class="far fa-trash-alt"></i><span class="d-none d-lg-inline"> Eliminar</span></button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>