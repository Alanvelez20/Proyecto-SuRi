@extends('components.miLayout')

@section('content')
<h1>Listado de consumos</h1><br>
    @include('parciales.form-error')
    
    
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('consumo.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('consumo.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Alimento</th>
                <th>
                    Cantidad del alimento
                </th>
                <th>
                    Costo del alimento
                </th>
                <th>
                    Fecha
                    <a href="{{ route('consumo.index', array_merge(request()->all(), ['sort_by' => 'fecha_consumo', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_consumo' ? 'desc' : 'asc'])) }}">
                        @if (request('sort_by') == 'fecha_consumo' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'fecha_consumo' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>
                    <form method="GET" action="{{ route('consumo.index') }}" style="display:inline;">
                        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                        <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                        <select name="lote_id_consumo" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                            <option style="color: black" value="">Lotes ᐁ</option>
                            @foreach($lotes as $lote)
                                <option style="color: black" value="{{ $lote->id }}" {{ request('lote_id_consumo') == $lote->id ? 'selected' : '' }}>
                                    {{ $lote->lote_nombre }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <th>
                    Cantidad de animales en lote
                    <a href="{{ route('consumo.index', array_merge(request()->all(), ['sort_by' => 'animales_cantidad', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'animales_cantidad' ? 'desc' : 'asc'])) }}">
                        @if (request('sort_by') == 'animales_cantidad' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'animales_cantidad' && request('sort_direction') == 'desc')
                            &#9660;
                        @else
                            &#9650;&#9660;
                        @endif
                    </a>
                </th>
                <th>Consumo por animal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consumos as $consumo)
                <tr>
                    <td>{{ $consumo->alimento->alimento_descripcion }}</td>
                    <td>{{ $consumo->alimento_cantidad_total }} kg</td>
                    <td>${{ $consumo->valor_dieta }}</td>
                    <td>{{ $consumo->fecha_consumo }}</td>
                    <td>{{ $consumo->lote->lote_nombre }}</td>
                    <td>{{ $consumo->animales_cantidad }}</td>
                    <td>{{ $consumo->alimento_cantidad_total / $consumo->animales_cantidad }} kg</td>
                    <td><a class="btn btn-dark btn-block" href="{{ route('consumo.show', $consumo) }}">Detalle</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

