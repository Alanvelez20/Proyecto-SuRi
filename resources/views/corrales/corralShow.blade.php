@extends('components.miLayout')

@section('content')
    <h1>Detalles del corral</h1>

    <ul>
        <li>Descripcion: {{ $corral->corral_nombre }}</li>
        <li>Cantidad: {{ $corral->corral_estado }}</li>
    </ul>

@endsection