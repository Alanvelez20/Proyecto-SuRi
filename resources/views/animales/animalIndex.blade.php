@extends('components.miLayout')

@section('content')
<h1>Animales</h1><br>

<h2>Gráficas</h2>
<div class="row mb-4">
    <div class="col-md-3">
        <canvas id="genderChart"></canvas>
    </div>
    <div class="col-md-4">
        <canvas id="loteChart"></canvas>
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
                    <a class="btn btn-dark btn-block" href="{{ route('animal.show', $animal) }}">Detalle</a> 
                    <a class="btn btn-dark btn-block" href="{{ route('animal.edit', $animal) }}">Editar o <br> Actualizar</a> 
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
    const genderChart = new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: ['Machos', 'Hembras'],
            datasets: [{
                data: [genderData.machos, genderData.hembras],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        }
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
                backgroundColor: '#36A2EB'
            }]
        }
    });
</script>
@endsection
