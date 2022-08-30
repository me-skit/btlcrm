<div class="row">
  <div class="col-md-12">
    {{ $people->links("pagination::bootstrap-4") }}
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-12">
    <table class="table table-hover table-responsive-md table-responsive-lg">
      <thead>
          <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Acept.</th>
            <th>Baut.</th>
            <th>Asiste</th>
            <th class="d-md-none d-lg-block">Sede</th>
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($people as $key => $person)
        <tr>
          <td>{{ ($people->currentPage() - 1) * 7 + $key + 1 }}</td>
          <td>
            {{ $person->full_name }} 
            {!! $person->death_date ? "<small class='badge badge-dark'>Q.D.E.P.</small>" : "" !!}
          </td>
          <td>{{ $person->accepted ? "Si" : "No" }}</td>
          <td>{{ $person->baptized ? "Si" : "No" }}</td>
          <td>
            @if (!$person->death_date)
              {{ $person->attend_church }}
            @endif
          </td>
          <td class="d-md-none d-lg-block">{{ $person->membership->campus_id ? $person->membership->campus->name : "" }}</td>
          <td>
            <div class="d-flex">
              <a href="{{ route('person.show', $person->id ) }}" class="btn btn-secondary mr-3"><i class="far fa-eye"></i> Detalles</a>
              <a href="{{ route('person.edit', $person->id ) }}" class="btn btn-primary mr-3"><i class="fas fa-pencil-alt"></i> Editar</a>
              <a href="{{ route('family.show', $person->family()->id ) . '?back=members' }}" class="btn btn-link mr-3"><i class="fas fa-house-user"></i> Familia</a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>
