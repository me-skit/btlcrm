@foreach ($people as $key => $person)
<tr>
  <td>{{ $key + 1 }}</td>
  <td>{{ $person->first_name }} {{ $person->second_name }} {{ $person->third_name }} {{ $person->first_surname }} {{ $person->second_surname }} {!! $person->disciplined ? "<span class='badge badge-danger'>Susp. Acta No. " . $person->act_number  . "</span>" : "" !!}</td>
  <td>{{ $person->role }}</td>
  <td>{{ $person->cellphone }}</td>
  <td>
    <a href="{{ route('person.show', $person->id) }}" class="btn btn-primary mr-3"><i class="far fa-eye"></i> Detalles</a>
  </td>
</tr>
@endforeach