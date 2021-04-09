<p class="my-0"><b>Privilegios:</b></p>

<ul class="list-group mt-1">
  @foreach ($privs_assigned as $privilege)
    <li class="list-group-item py-1">
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 pr-1">
          <div class="row">
            <div class="col-12 col-sm-4 col-md-5 col-lg-3 px-1">
              @if ($privilege->pivot->start_date)
                {{ \Carbon\Carbon::parse($privilege->pivot->start_date)->format('d/m/y') }} -
              @endif

              @if (! $privilege->pivot->end_date)
                Sin tiempo
              @else
                {{ \Carbon\Carbon::parse($privilege->pivot->end_date)->format('d/m/y') }}
              @endif
            </div>
            <div class="col-12 col-sm-8 col-md-7 col-lg-9 px-1">
              {{ $privilege->description }}
              {{ $privilege->pivot->privilege_role_id ? '- ' . $privilege->pivot->role->description : '' }}
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 text-right px-1">
          <button class="btn btn-success btn-sm py-0 mr-1">Modificar</button>
          <button class="btn btn-danger btn-sm py-0">Eliminar</button>
        </div>
      </div>
    </li>
  @endforeach
</ul>