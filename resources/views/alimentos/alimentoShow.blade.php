@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Detalle del alimento</h1>
    <ul>
        <li>Descripcion: {{ $alimento->alimento_descripcion }}</li>
        <li>Cantidad: {{ $alimento->alimento_cantidad }} kg</li>
        <li>Costo por kg: ${{ $alimento->alimento_costo }}</li>
    </ul>

    <h2>Archivos</h2>
            @if ($alimento->archivo_nombre != "null" && $alimento->archivo_nombre != "0")
                <h4>
                    <a href="{{ route('alimento.descarga', $alimento) }}">
                        <img src="{{ asset('mainlayout/img/descargar.png') }}" alt="Descargar" style="width: 20px; height: 20px;">
                        {{ $alimento->archivo_nombre }}
                    </a>
                </h4>
                @if($base64Image)
                    <div>
                        <img src="data:image/jpeg;base64,{{ $base64Image }}" alt="Imagen del Alimento" style="max-width: 300px; height: auto;">
                    </div>
                @endif
            @else
                <h4>No hay archivos adjuntos</h4>
            @endif
    
    
</div>
@endsection