@include('people.show.details')

<div id="privileges-{{ $person->id }}" class="mt-1 mb-2">
  @include('privilegehistory.index')
</div>

@can('administer')
  <div id="disciplines-{{ $person->id }}" class="mt-1 mb-2 ">
    @include('disciplinehistory.index')
  </div>
@endcan

@if ($person->membership->baptized)
  @include('people.show.addprivilege')

  @can('administer')
    @include('people.show.adddiscipline')
  @endcan
@endif
