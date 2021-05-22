@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h2>{{ $greeting }}</h2>

            <p>Seleccione el menú para ver las acciones disponibles.</p>
        </div>
    </div>
</div>
@endsection
