@extends('components.miLayout')

@section('content')
    <h1>Detalle del alimento</h1>

    <ul>
        <li>Descripcion: {{ $alimento->alimento_descripcion }}</li>
        <li>Cantidad: {{ $alimento->alimento_cantidad }}</li>
        <li>Costo: {{ $alimento->alimento_costo }}</li>
    </ul>

@endsection