@extends('components.miLayout')

@section('content')
    <h1>Detalle del animal</h1>

    <ul>
        <li>Especie: {{ $animal->animal_especie }}</li>
        <li>Género: {{ $animal->animal_genero }}</li>
        <li>Peso: {{ $animal->animal_peso }}</li>
        <li>Valor de compra: {{ $animal->animal_valor_compra }}</li>
        <li>Valor de venta: {{ $animal->animal_valor_venta }}</li>
        <li>Lote: {{ $animal->animal_id_lote }}</li>
    </ul>

@endsection