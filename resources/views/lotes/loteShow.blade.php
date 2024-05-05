@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Detalle del lote</h1>

    <ul>
        <li>Descripcion: {{ $lote->lote_nombre }}</li>
        <li>Cantidad: {{ $lote->lote_cantidad }}</li>
        <li>Corral: {{ $lote->lote_id_corral }}, {{ $nombre_corral }}</li>
    </ul>
</div>
@endsection