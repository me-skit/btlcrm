<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $users->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-hover table-responsive-md">
      <thead>
          <tr>
              <th>No.</th>
              <th>Correo</th>
              <th>Estado</th>
              <th class="d-none d-md-block">Rol</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $user)
          <tr>
            <td>{{ ($users->currentPage() - 1) * 7 + $key + 1 }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->active ? 'Activo' : 'Desactivado' }}</td>
            <td class="d-none d-md-block">{{ $user->role_name }}</td>
            <td>
              <div class="d-flex">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-3">Editar</a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>