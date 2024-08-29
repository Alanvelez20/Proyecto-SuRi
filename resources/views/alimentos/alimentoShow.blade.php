@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalle del Alimento</h1>

    <!-- Información del Alimento -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Información del Alimento</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Nombre</h5>
                            <p class="card-text">{{ $alimento->alimento_descripcion }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Cantidad (Kg)</h5>
                            <p class="card-text">{{ $alimento->alimento_cantidad }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Costo por Kg</h5>
                            <p class="card-text">$ {{ $alimento->alimento_costo }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Archivos Adjuntos -->
    <div class="card">
        <div class="card-header">
            <h3>Archivos Adjuntos</h3>
        </div>
        <div class="card-body">
            @if ($alimento->archivo_nombre != "null" && $alimento->archivo_nombre != "0")
                <h4 class="mb-3">
                    <a href="{{ route('alimento.descarga', $alimento) }}" class="btn btn-info">
                        <img src="{{ asset('mainlayout/img/descargar.png') }}" alt="Descargar" style="width: 20px; height: 20px;">
                        Descargar {{ $alimento->archivo_nombre }}
                    </a>
                </h4>
                @if($base64Image)
                    <div class="mb-3">
                        <img src="data:image/jpeg;base64,{{ $base64Image }}" alt="Imagen del Alimento" class="img-fluid" style="max-width: 300px; height: auto;">
                    </div>
                @endif
            @else
                <h4>No hay archivos adjuntos</h4>
            @endif
        </div>
    </div>
</div>
@endsection
