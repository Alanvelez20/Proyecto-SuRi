@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalle del Consumo</h1>

    <!-- Información del Consumo -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Detalles del Consumo</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del Alimento</h5>
                            <p class="card-text">{{ $alimento_descripcion }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Cantidad (Kg)</h5>
                            <p class="card-text">{{ $consumo->alimento_cantidad_total }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Costo</h5>
                            <p class="card-text">$ {{ $consumo->valor_dieta }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title">Fecha</h5>
                            <p class="card-text">{{ $consumo->fecha_consumo }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Lote</h5>
                            <p class="card-text"> {{ $nombre_lote }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

