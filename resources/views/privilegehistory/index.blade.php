@if ($privs_assigned->count())
<p class="my-0"><b><i class="fas fa-user-tie"></i> Privilegios:</b></p>

<ul class="list-group mt-1">
  @foreach ($privs_assigned as $privilege)
    <li class="list-group-item py-1">
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 pr-1 {{ $privilege->pivot->is_active ? '' : 'text-secondary' }}">
          <div class="row">
            <div class="col-12 col-sm-5 col-md-5 col-lg-4 px-1">
              {!! $privilege->pivot->is_active ? '' : '<s>' !!}
              <i class="far fa-id-card-alt"></i>
              @if ($privilege->pivot->start_date)
                {{ \Carbon\Carbon::parse($privilege->pivot->start_date)->format('d/m/y') }} -
              @else
                Indefinido -
              @endif

              @if ($privilege->pivot->end_date)
                {{ \Carbon\Carbon::parse($privilege->pivot->end_date)->format('d/m/y') }}
              @else
                Sin tiempo
              @endif
              {!! $privilege->pivot->is_active ? '' : '</s>' !!}
            </div>
            <div class="col-12 col-sm-7 col-md-7 col-lg-8 px-1">
              {!! $privilege->pivot->is_active ? '' : '<s>' !!}
              {{ $privilege->description }}
              @if ($privilege->pivot->is_active)
                {!! $privilege->pivot->privilege_role_id ? "<span class='badge badge-dark'>" . $privilege->pivot->role->description . "</span>"  : "" !!}
              @else
                {!! $privilege->pivot->privilege_role_id ? "<span class='badge badge-secondary'>" . $privilege->pivot->role->description . "</span>"  : "" !!}
              @endif

              @can('administer')
                {!! ($has_discipline and $privilege->pivot->is_active) ? "<span class='badge badge-danger'>Susp. Act. No. " . $has_discipline->act_number . "</span>"  : "" !!}
              @else
                @if ($person->sex == 'M')
                  {!! ($has_discipline and $privilege->pivot->is_active) ? "<span class='badge badge-danger'>Susppendido</span>"  : "" !!}
                @else
                  {!! ($has_discipline and $privilege->pivot->is_active) ? "<span class='badge badge-danger'>Susppendida</span>"  : "" !!}
                @endif
              @endcan
              {!! $privilege->pivot->is_active ? '' : '</s>' !!}
            </div>
          </div>
        </div>
        @can('administer')
        <div class="col-sm-12 col-md-4 col-lg-3 text-right px-1">
          <button
            class="btn btn-success btn-sm py-0 mr-1"
            name="btn-edit-privilege"
            data-id="{{ $privilege->pivot->id }}"
            data-toggle="modal"
            data-target="#editPrivilegeModal">
            Modificar
          </button>
          <button
            class="btn btn-danger btn-sm py-0"
            name="btn-del-privilege"
            data-id="{{ $privilege->pivot->id }}"
            data-toggle="modal"
            data-target="#delPrivilegeModal">
            Eliminar
          </button>
        </div>
        @endcan
      </div>
    </li>
  @endforeach
</ul>
@endif