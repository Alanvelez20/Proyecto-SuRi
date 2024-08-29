@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Ventas</h1><br>
    <h2>Gráficas y resúmenes de información</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <canvas id="graficoTotales"></canvas>
        </div>
        <div class="col-md-6">
            <!-- Cuadro de Resumen -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Resumen de Ventas</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Ganancia Total</h4>
                    <p class="card-text">
                        <strong>$ {{ number_format($gananciaTotal, 2) }}</strong>
                    </p>
                    <h5 class="mt-4">Detalles</h5>
                    <ul class="list-unstyled">
                        <li><strong>Total Compra:</strong> $ {{ number_format($totalCompra, 2) }}</li>
                        <li><strong>Total Venta:</strong> $ {{ number_format($totalVenta, 2) }}</li>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <small style="color: black">Datos calculados a partir de todas las ventas registradas.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de animales vendidos</h5>
                    <p class="card-text">{{ $totalAnimales }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cantidad total de Alimento</h5>
                    <p class="card-text">{{ $totalConsumoAlimento }} Kg</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Costo total del Alimento</h5>
                    <p class="card-text">$ {{ $totalCostoAlimento }}</p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <h2>Listado de ventas</h2>

    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('ventas.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('venta.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
        <div class="col-md-2">
            <form method="GET" action="{{ route('venta.index') }}" style="display:inline;">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                <input type="hidden" name="anio_venta" value="{{ request('anio_venta') }}">
                <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
                <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
                <select name="mes_venta" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                    <option style="color: black" value="">Filtrar por mes de venta ᐁ</option>
                    @foreach($meses as $numero => $mes)
                        <option style="color: black" value="{{ $numero }}" {{ request('mes_venta') == $numero ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-md-2">
            <form method="GET" action="{{ route('venta.index') }}" style="display:inline;">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                <input type="hidden" name="mes_venta" value="{{ request('mes_venta') }}">
                <input type="hidden" name="especie_filter" value="{{ request('especie_filter') }}">
                <input type="hidden" name="genero_filter" value="{{ request('genero_filter') }}">
                <select name="anio_venta" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                    <option style="color: black" value="">Filtrar por año de venta ᐁ</option>
                    @foreach(range(date('Y'), 2000) as $year)
                        <option style="color: black" value="{{ $year }}" {{ request('anio_venta') == $year ? 'selected' : '' }}>
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
                    <!-- Las columnas de la tabla -->
                    <th>Arete
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
                            <input type="hidden" name="anio_venta" value="{{ request('anio_venta') }}">
                            <input type="hidden" name="mes_venta" value="{{ request('mes_venta') }}">
                            <select name="especie_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                                <option style="color: black" value="">Raza ᐁ</option>
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
                            <input type="hidden" name="anio_venta" value="{{ request('anio_venta') }}">
                            <input type="hidden" name="mes_venta" value="{{ request('mes_venta') }}">
                            <select name="genero_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                                <option style="color: black" value="">Sexo ᐁ</option>
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
                    <th>Precio de compra <br>(por Kg)</th>
                    <th>Total de compra</th>
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
                    <th>Consumo total <br>de alimento</th>
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
                        <td>{{ $venta->animal_peso_inicial }} Kg</td>
                        <td>{{ $venta->animal_peso_final }} Kg</td>
                        <td>$ {{ $venta->animal_valor_compra }}</td>
                        <td>$ {{ $venta->animal_valor_compra * $venta->animal_peso_inicial }}</td>
                        <td>$ {{ $venta->animal_valor_venta }}</td>
                        <td>{{ $venta->consumo_total }} Kg</td>
                        <td>$ {{ $venta->costo_total }}</td>
                        <td>{{ $venta->fecha_ingreso }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>
                            <a class="btn btn-info btn-block" href="{{ route('venta.show', $venta) }}">Detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('graficoTotales').getContext('2d');
            var graficoTotales = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($graficoDatos['labels']),
                    datasets: @json($graficoDatos['datasets'])
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
