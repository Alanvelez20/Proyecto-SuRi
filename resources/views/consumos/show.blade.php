@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Detalle del consumo: </h1>

    <ul>
        <li>Descripcion: {{ $consumo->alimento_descripcion }}</li>
        <li>Cantidad: {{ $consumo->alimento_cantidad_total }} kg</li>
        <li>Costo: ${{ $consumo->valor_dieta }}</li>
        <li>Fecha: {{ $consumo->fecha_consumo }}</li>
        <li>Horario: {{ $consumo->hora_consumo }}</li>
        <li>Corral: {{ $consumo->lote_id_consumo }} - {{ $nombre_lote }}</li>
    </ul>
    </div>
@endsection
