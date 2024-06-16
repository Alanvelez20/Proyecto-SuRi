@extends('components.miLayout')

@section('content')
    <h1>Datos de los animales</h1><br>

    <div class="form-group">
        <form method="get" action="/search1">
            <div class="input-group">
                <input class="form-control" name="search1" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>
                    N° Arete
                    <a href="{{ route('animal.index', ['sort_by' => 'arete', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'arete' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'arete' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'arete' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Especie</th>
                <th>Género</th>
                <th>
                    Peso inicial
                    <a href="{{ route('animal.index', ['sort_by' => 'animal_peso_inicial', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_peso_inicial' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animal_peso_inicial' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_peso_inicial' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Peso actual/final
                    <a href="{{ route('animal.index', ['sort_by' => 'animal_peso_final', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_peso_final' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animal_peso_final' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_peso_final' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Valor de compra
                    <a href="{{ route('animal.index', ['sort_by' => 'animal_valor_compra', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_valor_compra' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animal_valor_compra' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_valor_compra' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Valor de venta
                    <a href="{{ route('animal.index', ['sort_by' => 'animal_valor_venta', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_valor_venta' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animal_valor_venta' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_valor_venta' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Consumo total
                    <a href="{{ route('animal.index', ['sort_by' => 'consumo_total', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'consumo_total' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'consumo_total' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'consumo_total' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Fecha de ingreso
                    <a href="{{ route('animal.index', ['sort_by' => 'fecha_ingreso', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_ingreso' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'fecha_ingreso' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'fecha_ingreso' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    Numero de lote
                    <a href="{{ route('animal.index', ['sort_by' => 'animal_id_lote', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_id_lote' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'animal_id_lote' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_id_lote' && request('sort_direction') == 'desc')
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
            @foreach ($animales as $animal)
                <tr>
                    <td>{{ $animal->arete }}</td>
                    <td>{{ $animal->animal_especie }}</td>
                    <td>{{ $animal->animal_genero }}</td>
                    <td>{{ $animal->animal_peso_inicial }}</td>
                    <td>{{ $animal->animal_peso_final }}</td>
                    <td>{{ $animal->animal_valor_compra }}</td>
                    <td>{{ $animal->animal_valor_venta }}</td>
                    <td>{{ $animal->consumo_total }}</td>
                    <td>{{ $animal->fecha_ingreso }}</td>
                    <td>{{ $animal->animal_id_lote }}</td>
                    <td>
                        <a class="btn btn-dark btn-block" href="{{ route('animal.show', $animal) }}">Detalle</a> 
                        <a class="btn btn-dark btn-block" href="{{ route('animal.edit', $animal) }}">Editar</a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
