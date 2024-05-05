@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Detalle del lote: {{ $lote->lote_nombre }}</h1>

    <ul>
        @foreach ($lote->alimentos as $alimento)
            <li>{{ $alimento->alimento_descripcion }}</li>
        @endforeach
    </ul>
    </div>
@endsection
