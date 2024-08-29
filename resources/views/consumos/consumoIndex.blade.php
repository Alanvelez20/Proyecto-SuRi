@extends('components.miLayout')

@section('content')
@include('parciales.form-error')
<h1 class="text-center">Consumos</h1><br>
<h2>Resúmenes de los consumos</h2>
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad total del alimento</h5>
                <p class="card-text">{{ $totalAlimentoCantidad }} kg</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Costo total del alimento</h5>
                <p class="card-text">${{ $totalCostoAlimento }}</p>
            </div>
        </div>
    </div>
</div>

<h2>Listado de consumos</h2>
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('consumo.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('consumo.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
        <div class="col-md-2">
            <form method="GET" action="{{ route('consumo.index') }}" style="display:inline;">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                <input type="hidden" name="anio_consumo" value="{{ request('anio_consumo') }}">
                <input type="hidden" name="lote_id_consumo" value="{{ request('lote_id_consumo') }}">
                <input type="hidden" name="alimento_id" value="{{ request('alimento_id') }}">
                <select name="mes_consumo" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                    <option style="color: black" value="">Filtrar por Mes ᐁ</option>
                    @foreach($meses as $numero => $mes)
                        <option style="color: black" value="{{ $numero }}" {{ request('mes_consumo') == $numero ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-md-2">
            <form method="GET" action="{{ route('consumo.index') }}" style="display:inline;">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                <input type="hidden" name="mes_consumo" value="{{ request('mes_consumo') }}">
                <input type="hidden" name="lote_id_consumo" value="{{ request('lote_id_consumo') }}">
                <input type="hidden" name="alimento_id" value="{{ request('alimento_id') }}">
                <select name="anio_consumo" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                    <option style="color: black" value="">Filtrar por Año ᐁ</option>
                    @foreach(range(date('Y'), 2000) as $year)
                        <option style="color: black" value="{{ $year }}" {{ request('anio_consumo') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <form method="GET" action="{{ route('consumo.index') }}" style="display:inline;">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                            <input type="hidden" name="anio_consumo" value="{{ request('anio_consumo') }}">
                            <input type="hidden" name="mes_consumo" value="{{ request('mes_consumo') }}">
                            <input type="hidden" name="lote_id_consumo" value="{{ request('lote_id_consumo') }}">
                            <select name="alimento_id" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                                <option style="color: black" value="">Alimentos ᐁ</option>
                                @foreach($alimentos as $alimento)
                                    <option style="color: black" value="{{ $alimento->id }}" {{ request('alimento_id') == $alimento->id ? 'selected' : '' }}>
                                        {{ $alimento->alimento_descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </th>
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
                            <input type="hidden" name="anio_consumo" value="{{ request('anio_consumo') }}">
                            <input type="hidden" name="mes_consumo" value="{{ request('mes_consumo') }}">
                            <input type="hidden" name="alimento_id" value="{{ request('alimento_id') }}">
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
                        <td>{{ $consumo->alimento_cantidad_total }} Kg</td>
                        <td>$ {{ $consumo->valor_dieta }}</td>
                        <td>{{ $consumo->fecha_consumo }}</td>
                        <td>{{ $consumo->lote->lote_nombre }}</td>
                        <td>{{ $consumo->animales_cantidad }}</td>
                        <td>{{ number_format($consumo->alimento_cantidad_total / $consumo->animales_cantidad, 2) }} Kg</td>
                        
                        <td>
                            <a class="btn btn-info btn-block" href="{{ route('consumo.show', $consumo) }}">Detalle</a>
                            <a class="btn btn-info btn-block" href="{{ route('consumo.edit', $consumo) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

