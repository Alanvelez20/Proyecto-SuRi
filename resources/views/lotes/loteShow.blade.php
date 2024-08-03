@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles del Lote</h1>

    <div class="card">
        <div class="card-header">
            <h3>Detalles del Lote</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Descripción -->
                <div class="col-md-6 mb-3">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del lote</h5>
                            <p class="card-text">{{ $lote->lote_nombre }}</p>
                        </div>
                    </div>
                </div>

                <!-- Cantidad -->
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Cantidad de animales</h5>
                            <p class="card-text">{{ $lote->lote_cantidad }}</p>
                        </div>
                    </div>
                </div>

                <!-- Consumo Total del Lote -->
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Consumo Total del Lote (kg)</h5>
                            <p class="card-text">{{ $lote->consumo_total_alimento }} kg</p>
                        </div>
                    </div>
                </div>

                <!-- Corral -->
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Corral</h5>
                            <p class="card-text">{{ $nombre_corral }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
