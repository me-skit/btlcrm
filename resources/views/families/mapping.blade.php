@extends('layouts.app')

@section('content')

<div class="container">
  <div id="map" data-map="0"></div>
</div>

<script
  src="https://maps.googleapis.com/maps/api/js?key=<API_KEY>&callback=initMap&libraries=&v=weekly"
  async
>
</script>

@endsection