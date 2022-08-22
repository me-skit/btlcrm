<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $privileges->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-hover table-responsive-md">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nombre</th>
          <th>Preferencias</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($privileges as $key => $privilege)
          <tr>
            <td>{{ ($privileges->currentPage() - 1) * 7 + $key + 1 }}</td>
            <td>{{ $privilege->name }}</td>
            <td>{{ $privilege->preferrences }}</td>
            <td>
              <div class="d-flex">
                <a href="{{ route('privilege.edit', $privilege->id) }}" class="btn btn-primary mr-3"><i class="fas fa-pencil-alt"></i> Editar</a>
                
                <form action="{{ route('privilege.destroy', $privilege->id) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>