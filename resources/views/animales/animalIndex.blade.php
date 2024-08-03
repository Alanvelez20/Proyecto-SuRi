@extends('components.miLayout')

@section('content')
<h1 class="text-center">Animales</h1><br>

<h2>Gráficas</h2>
<div class="row mb-4">
    <div class="col-md-3">
        <canvas id="genderChart"></canvas>
    </div>
    <div class="col-md-4">
        <canvas id="loteChart"></canvas>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad total de animales</h5>
                <p class="card-text">{{ $totalAnimales }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Cantidad de Alimento</h5>
                <p class="card-text">{{ $totalConsumoAlimento }} kg</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Costo del Alimento</h5>
                <p class="card-text">${{ $totalCostoAlimento }}</p>
            </div>
        </div>
    </div>
</div>
<br>
<h2>Datos de los animales</h2>
<div class="row mb-4">
    <div class="col-md-2">
        <a href="{{ route('animales.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
    </div>
    <div class="col-md-2">
        <a href="{{ route('animal.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
    </div>
    <div class="col-md-2">
        <form method="GET" action="{{ route('animal.index') }}" style="display:inline;">
            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
            <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
            <input type="hidden" name="anio_ingreso" value="{{ request('anio_ingreso') }}">
            <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
            <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
            <input type="hidden" name="lote_filter" value="{{ request('lote_filter') }}">
            <select name="mes_ingreso" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                <option style="color: black" value="">Filtrar por mes de ingreso ᐁ</option>
                @foreach($meses as $numero => $mes)
                    <option style="color: black" value="{{ $numero }}" {{ request('mes_ingreso') == $numero ? 'selected' : '' }}>
                        {{ $mes }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="col-md-2">
        <form method="GET" action="{{ route('animal.index') }}" style="display:inline;">
            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
            <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
            <input type="hidden" name="mes_ingreso" value="{{ request('mes_ingreso') }}">
            <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
            <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
            <input type="hidden" name="lote_filter" value="{{ request('lote_filter') }}">
            <select name="anio_ingreso" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                <option style="color: black" value="">Filtrar por año de ingreso ᐁ</option>
                @foreach(range(date('Y'), 2000) as $year)
                    <option style="color: black" value="{{ $year }}" {{ request('anio_ingreso') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>
                N° Arete
                <a href="{{ route('animal.index', array_merge(request()->query(), ['sort_by' => 'arete', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'arete' ? 'desc' : 'asc'])) }}">
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
                <form method="GET" action="{{ route('animal.index') }}" style="display:inline;">
                    <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
                    <input type="hidden" name="lote_filter" value="{{ request('lote_filter') }}">
                    <input type="hidden" name="anio_ingreso" value="{{ request('anio_ingreso') }}">
                    <input type="hidden" name="mes_ingreso" value="{{ request('mes_ingreso') }}">
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
                <form method="GET" action="{{ route('animal.index') }}" style="display:inline;">
                    <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
                    <input type="hidden" name="lote_filter" value="{{ request('lote_filter') }}">
                    <input type="hidden" name="anio_ingreso" value="{{ request('anio_ingreso') }}">
                    <input type="hidden" name="mes_ingreso" value="{{ request('mes_ingreso') }}">
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
            <th>Peso inicial</th>
            <th>Peso actual/final</th>
            <th>Valor de compra <br>(por kg)</th>
            <th>Total de compra</th>
            <th>Consumo total</th>
            <th>Costo total</th>
            <th>
                Fecha de ingreso
                <a href="{{ route('animal.index', array_merge(request()->query(), ['sort_by' => 'fecha_ingreso', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'fecha_ingreso' ? 'desc' : 'asc'])) }}">
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
                <form method="GET" action="{{ route('animal.index') }}" style="display:inline;">
                    <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
                    <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
                    <input type="hidden" name="anio_ingreso" value="{{ request('anio_ingreso') }}">
                    <input type="hidden" name="mes_ingreso" value="{{ request('mes_ingreso') }}">
                    <select name="lote_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                        <option style="color: black" value="">Número de lote ᐁ</option>
                        @foreach ($lotes as $lote)
                            <option style="color: black" value="{{ $lote->id }}" {{ request('lote_filter') == $lote->id ? 'selected' : '' }}>
                                {{ $lote->lote_nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
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
                <td>{{ $animal->animal_peso_inicial }} kg</td>
                <td>{{ $animal->animal_peso_final }} kg</td>
                <td>${{ $animal->animal_valor_compra }}</td>
                <td>${{ $animal->animal_valor_compra * $animal->animal_peso_inicial }}</td>
                <td>{{ $animal->consumo_total }}kg</td>
                <td>${{ $animal->costo_total }}</td>
                <td>{{ $animal->fecha_ingreso }}</td>
                <td>{{ $animal->lote->lote_nombre }}</td>
                <td>
                    <a class="btn btn-info btn-block" href="{{ route('animal.show', $animal) }}">Detalle</a> 
                    <a class="btn btn-info btn-block" href="{{ route('animal.edit', $animal) }}">Editar o <br> Actualizar</a> 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos para la gráfica de género
    const genderData = @json($genderData);
    const genderCtx = document.getElementById('genderChart').getContext('2d');

    document.addEventListener('DOMContentLoaded', function() {
    var genderCtx = document.getElementById('genderChart').getContext('2d');
    var genderChart = new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: @json($genderData['labels']),
            datasets: @json($genderData['datasets'])
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            }
        }
    });
});


    // Datos para la gráfica de lotes
    const loteData = @json($loteData);
    const loteCtx = document.getElementById('loteChart').getContext('2d');
    const loteChart = new Chart(loteCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(loteData),
            datasets: [{
                label: 'Cantidad de Animales',
                data: Object.values(loteData),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
