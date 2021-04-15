<p class="my-0"><b>Privilegios:</b></p>

<ul class="list-group mt-1">
  @foreach ($privs_assigned as $privilege)
    <li class="list-group-item py-1">
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 pr-1">
          <div class="row">
            <div class="col-12 col-sm-4 col-md-5 col-lg-3 px-1">
              {!! $privilege->pivot->is_active ? '' : '<s>' !!}
              @if ($privilege->pivot->start_date)
                {{ \Carbon\Carbon::parse($privilege->pivot->start_date)->format('d/m/y') }} -
              @endif

              @if (! $privilege->pivot->end_date)
                Sin tiempo
              @else
                {{ \Carbon\Carbon::parse($privilege->pivot->end_date)->format('d/m/y') }}
              @endif
              {!! $privilege->pivot->is_active ? '' : '</s>' !!}
            </div>
            <div class="col-12 col-sm-8 col-md-7 col-lg-9 px-1">
              {!! $privilege->pivot->is_active ? '' : '<s>' !!}
              {{ $privilege->description }}
              {{-- {!! $privilege->pivot->privilege_role_id ? "<h5 class='d-inline'><span class='badge badge-secondary font-weight-normal'>" . $privilege->pivot->role->description . "</span></h5>"  : "" !!} --}}
              {!! $privilege->pivot->privilege_role_id ? "<span class='badge badge-dark'>" . $privilege->pivot->role->description . "</span>"  : "" !!}
              {!! $privilege->pivot->is_active ? '' : '</s>' !!}
            </div>
          </div>
        </div>
        @can('administer')
        <div class="col-sm-12 col-md-4 col-lg-3 text-right px-1">
          <button class="btn btn-success btn-sm py-0 mr-1">Modificar</button>
          <button class="btn btn-danger btn-sm py-0">Eliminar</button>
        </div>
        @endcan
      </div>
    </li>
  @endforeach
</ul>