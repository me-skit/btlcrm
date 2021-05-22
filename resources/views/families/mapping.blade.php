@extends('layouts.app')

@section('content')

<div class="container">
  <div id="map" data-map="0"></div>
</div>

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8j13SI1rqi2uNJ1OpHbE20zdMEaG8d9I&callback=initMap&libraries=&v=weekly"
  async
>
</script>

@endsection