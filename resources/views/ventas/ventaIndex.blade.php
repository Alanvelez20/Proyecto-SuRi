@extends('components.miLayout')

@section('content')
    <h1>Ventas</h1>
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('ventas.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('venta.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Arete
                    <a href="{{ route('venta.index', array_merge(request()->except('sort_by', 'sort_direction'), ['sort_by' => 'arete', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'arete' ? 'desc' : 'asc'])) }}">
                        @if (request('sort_by') == 'arete' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'arete' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    <form method="GET" action="{{ route('venta.index') }}" style="display:inline;">
                        <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
                        <select name="especie_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                            <option style="color: black" value="">Especie ᐁ</option>
                            @foreach ($especies as $especie)
                                <option style="color: black" value="{{ $especie }}" {{ request('especie_filter') == $especie ? 'selected' : '' }}>
                                    {{ $especie }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <th>
                    <form method="GET" action="{{ route('venta.index') }}" style="display:inline;">
                        <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
                        <select name="genero_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                            <option style="color: black" value="">Género ᐁ</option>
                            @foreach ($generos as $genero)
                                <option style="color: black" value="{{ $genero }}" {{ request('genero_filter') == $genero ? 'selected' : '' }}>
                                    {{ $genero }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <th>Peso Inicial</th>
                <th>Peso Final</th>
                <th>Valor Compra</th>
                <th>
                    Valor Venta
                    <a href="{{ route('venta.index', array_merge(request()->except('sort_by', 'sort_direction'), ['sort_by' => 'animal_valor_venta', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animal_valor_venta' ? 'desc' : 'asc'])) }}">
                        @if (request('sort_by') == 'animal_valor_venta' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animal_valor_venta' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Consumo total</th>
                <th>Costo total</th>
                <th>
                    Fecha Ingreso
                    <a href="{{ route('venta.index', array_merge(request()->except('sort_by', 'sort_direction'), ['sort_by' => 'fecha_ingreso', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_ingreso' ? 'desc' : 'asc'])) }}">
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
                    Fecha Venta
                    <a href="{{ route('venta.index', array_merge(request()->except('sort_by', 'sort_direction'), ['sort_by' => 'fecha_venta', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_venta' ? 'desc' : 'asc'])) }}">
                        @if (request('sort_by') == 'fecha_venta' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'fecha_venta' && request('sort_direction') == 'desc')
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
