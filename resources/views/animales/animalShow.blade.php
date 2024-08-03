@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalle del Animal</h1>
    
    <div class="card">
        <div class="card-header">
            <h3>Información del Animal</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Arete</h5>
                            <p class="card-text"><strong>{{ $animal->arete }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Especie</h5>
                            <p class="card-text">{{ $animal->animal_especie }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Género</h5>
                            <p class="card-text">{{ $animal->animal_genero }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Peso Inicial</h5>
                            <p class="card-text">{{ $animal->animal_peso_inicial }} kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Peso Actual</h5>
                            <p class="card-text">{{ $animal->animal_peso_final }} kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title">Valor de Compra (Por KG)</h5>
                            <p class="card-text">${{ $animal->animal_valor_compra }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-light">
                        <div class="card-body">
                            <h5 class="card-title">Valor Total de la Compra</h5>
                            <p class="card-text">${{ $animal->animal_valor_compra * $animal->animal_peso_inicial }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-dark">
                        <div class="card-body">
                            <h5 class="card-title">Consumo Total de Alimento</h5>
                            <p class="card-text">{{ $animal->consumo_total }} kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Fecha de Ingreso</h5>
                            <p class="card-text">{{ $animal->fecha_ingreso }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Lote</h5>
                            <p class="card-text">{{ $nombre_lote }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
