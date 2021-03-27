<div class="row">
  <div class="col-md-10 offset-md-1">
    {{ $families->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10">
    <table class="table table-hover table-responsive-md">
      <thead>
          <tr>
              <th>No.</th>
              <th>Apellidos de Familia</th>
              <th>Lugar</th>
              <th>Dirección</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($families as $key => $family)
          <tr>
            <td>{{ ($families->currentPage() - 1) * 7 + $key + 1 }}</td>
            <td>{{ $family->family_name }}</td>
            <td>{{ $family->village->name }}</td>
            <td>{{ $family->address }}</td>
            <td>
              <div class="d-flex">
                <a href="{{ route('family.show', $family->id ) }}" class="btn btn-primary mr-3">Detalles</a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>