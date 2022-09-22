<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $users->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-sm table-hover table-responsive-sm">
      <thead>
          <tr>
              <th class="text-center">No.</th>
              <th>Correo</th>
              <th>Estado</th>
              <th>Rol</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $user)
          <tr>
            <td class="align-middle text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
            <td class="align-middle">{{ $user->email }}</td>
            <td class="align-middle">{{ $user->active ? 'Activo' : 'Desactivado' }}</td>
            <td class="align-middle">{{ $user->role_name }}</td>
            <td class="align-middle">
              <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary mr-3"><i class="fas fa-pencil-alt"></i><span class="d-none d-lg-inline"> Editar</span></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>