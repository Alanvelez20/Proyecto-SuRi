@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Detalle del animal</h1>
    <ul>
        <li><b>Arete: {{ $animal->arete }}</b></li>
        <li>Especie: {{ $animal->animal_especie }}</li>
        <li>Género: {{ $animal->animal_genero }}</li>
        <li>Peso inicial: {{ $animal->animal_peso_inicial }} kg</li>
        <li>Peso actual/final: {{ $animal->animal_peso_final }} kg</li>
        <li>Valor de compra: ${{ $animal->animal_valor_compra }}</li>
        <li>Valor de venta: ${{ $animal->animal_valor_venta }}</li>
        <li>Consumo total de alimento: {{ $animal->consumo_total }}</li>
        <li>Fehca de ingreso: {{ $animal->fecha_ingreso }}</li>
        <li>Lote: {{ $animal->animal_id_lote }} - {{ $nombre_lote }}</li>
    </ul>
</div>
@endsection