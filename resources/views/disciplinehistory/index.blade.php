<p class="my-0"><b>Disciplinas:</b></p>

<ul class="list-group mt-1">
  @foreach ($disciplines as $discipline)
    <li class="list-group-item py-1">
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 pr-1">
          <div class="row">
            <div class="col-12 col-sm-4 col-md-5 col-lg-3 px-1">
              {!! $discipline->is_active ? '' : '<s>' !!}
              @if ($discipline->start_date)
                {{ \Carbon\Carbon::parse($discipline->start_date)->format('d/m/y') }} -
              @endif

              @if (! $discipline->end_date)
                Indefinido
              @else
                {{ \Carbon\Carbon::parse($discipline->end_date)->format('d/m/y') }}
              @endif
              {!! $discipline->is_active ? '' : '</s>' !!}
            </div>
            <div class="col-12 col-sm-8 col-md-7 col-lg-9 px-1">
              {!! $discipline->is_active ? '' : '<s>' !!}
              {!! $discipline->description . " <span class='badge badge-dark'>Acta " . $discipline->act_number . "</span>" !!}
              {!! $discipline->is_active ? '' : '</s>' !!}
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