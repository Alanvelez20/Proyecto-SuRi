@extends('components.miLayout')

@section('content')
<h1>Listado de consumos</h1><br>
    @include('parciales.form-error')

    <div class="form-group">
        <form method="get" action="/search0">
            <div class="input-group">
                <input class="form-control" name="search0" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Alimento</th>
                <th>
                    Cantidad del alimento
                    <a href="{{ route('consumo.index', ['sort_by' => 'alimento_cantidad_total', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'alimento_cantidad_total' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'alimento_cantidad_total' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'alimento_cantidad_total' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Costo del alimento
                    <a href="{{ route('consumo.index', ['sort_by' => 'valor_dieta', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'valor_dieta' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'valor_dieta' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'valor_dieta' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Fecha
                    <a href="{{ route('consumo.index', ['sort_by' => 'fecha_consumo', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_consumo' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'fecha_consumo' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'fecha_consumo' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Horario</th>
                <th>
                    Lote
                    <a href="{{ route('consumo.index', ['sort_by' => 'lote_id_consumo', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'lote_id_consumo' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'lote_id_consumo' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'lote_id_consumo' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Cantidad de animales en el lote
                    <a href="{{ route('consumo.index', ['sort_by' => 'animales_cantidad', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animales_cantidad' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animales_cantidad' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animales_cantidad' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consumos as $consumo)
                <tr>
                    <td>{{ $consumo->alimento->alimento_descripcion }}</td>
                    <td>{{ $consumo->alimento_cantidad_total }}kg</td>
                    <td>${{ $consumo->valor_dieta }}</td>
                    <td>{{ $consumo->fecha_consumo }}</td>
                    <td>{{ $consumo->hora_consumo }}</td>
                    <td>{{ $consumo->lote->lote_nombre }}</td>
                    <td>{{ $consumo->animales_cantidad }}</td>
                    <td><a class="btn btn-dark btn-block" href="{{ route('consumo.show', $consumo) }}">Detalle</a> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
