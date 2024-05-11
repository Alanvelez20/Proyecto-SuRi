@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Detalle del alimento</h1>
    <ul>
        <li>Descripcion: {{ $alimento->alimento_descripcion }}</li>
        <li>Cantidad: {{ $alimento->alimento_cantidad }}</li>
        <li>Costo: {{ $alimento->alimento_costo }}</li>
    </ul>

    <h2>Archivos</h2>
    <ul>
        <li><a href="{{route('alimento.descarga', $alimento) }}">{{ $alimento->archivo_nombre}}</a></li>
    </ul>
    
    
</div>
@endsection