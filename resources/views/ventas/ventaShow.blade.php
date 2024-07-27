@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Detalle de la venta: </h1>
        <div class="form-group">
            <ul>
                <li><b>Arete: {{ $venta->arete }} </b></li>
                <li>Especie: {{ $venta->animal_especie }} </li>
                <li>Genero: {{ $venta->animal_genero }}</li>
                <li>Peso inicial: {{ $venta->animal_peso_inicial }} kg</li>
                <li>Peso final: {{ $venta->animal_peso_final }} kg</li>
                <li>Valor de compra: ${{ $venta->animal_valor_compra }} </li>
                <li>Valor de venta: ${{ $venta->animal_valor_venta }} </li>
                <li>Consumo total de alimento: {{ $venta->consumo_total }} kg</li>
                <li>Costo total: ${{ $venta->costo_total }} </li>
                <li>Fecha de ingreso: {{ $venta->fecha_ingreso }} </li>
                <li>Fecha de venta: {{ $venta->fecha_venta }} </li>
            </ul>
        </div>
    </div>
@endsection
