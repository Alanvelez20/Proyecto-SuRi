@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalle de la Venta</h1>

    <div class="card">
        <div class="card-header">
            <h3>Información de la Venta</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Arete</h5>
                            <p class="card-text"><strong>{{ $venta->arete }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Raza</h5>
                            <p class="card-text">{{ $venta->animal_especie }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Sexo</h5>
                            <p class="card-text">{{ $venta->animal_genero }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Peso Inicial</h5>
                            <p class="card-text">{{ $venta->animal_peso_inicial }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Peso Final</h5>
                            <p class="card-text">{{ $venta->animal_peso_final }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title">Precio de Compra</h5>
                            <p class="card-text">$ {{ $venta->animal_valor_compra }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-light">
                        <div class="card-body">
                            <h5 class="card-title">Valor total de la Compra</h5>
                            <p class="card-text">$ {{ $venta->animal_valor_compra * $venta->animal_peso_inicial }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-dark">
                        <div class="card-body">
                            <h5 class="card-title">Valor de Venta</h5>
                            <p class="card-text">$ {{ $venta->animal_valor_venta }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Consumo Total de Alimento</h5>
                            <p class="card-text">{{ $venta->consumo_total }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Costo Total</h5>
                            <p class="card-text">$ {{ $venta->costo_total }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">Fecha de Ingreso</h5>
                            <p class="card-text">{{ $venta->fecha_ingreso }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Fecha de Venta</h5>
                            <p class="card-text">{{ $venta->fecha_venta }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
