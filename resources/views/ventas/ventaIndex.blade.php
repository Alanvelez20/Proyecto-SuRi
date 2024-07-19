@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Ventas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Arete</th>
                <th>Especie</th>
                <th>Género</th>
                <th>Peso Inicial</th>
                <th>Peso Final</th>
                <th>Valor Compra</th>
                <th>Valor Venta</th>
                <th>Consumo total</th>
                <th>Costo total</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->arete }}</td>
                    <td>{{ $venta->animal_especie }}</td>
                    <td>{{ $venta->animal_genero }}</td>
                    <td>{{ $venta->animal_peso_inicial }} kg</td>
                    <td>{{ $venta->animal_peso_final }} kg</td>
                    <td>$ {{ $venta->animal_valor_compra }}</td>
                    <td>$ {{ $venta->animal_valor_venta }}</td>
                    <td>{{ $venta->consumo_total }} kg</td>
                    <td>$ {{ $venta->costo_total }}</td>
                    <td>{{ $venta->fecha_ingreso }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>
                        <a class="btn btn-dark btn-block" href="{{ route('venta.show', $venta) }}">Detalle</a> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
