@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Lotes</h1><br>

    
    <h2>Resúmenes de lotes</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cantidad total de lotes</h5>
                    <p class="card-text">{{ $totalLotes}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total cantidad de alimento consumido</h5>
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
    <h2>Datos de los lotes</h2>
    <div class="form-group">
        <form method="get" action="/search2">
            <div class="input-group">
                <input class="form-control" name="search2" placeholder="Buscar lote">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('lotes.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('lote.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>
                    Cantidad
                </th>
                <th>
                    Consumo total de alimento
                </th>
                <th>
                    Costo total de alimento
                </th>
                <th>
                    Corral
                </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lotes as $lote)
                <tr>
                    <td>{{ $lote->lote_nombre }}</td>
                    <td>{{ $lote->lote_cantidad }}</td>
                    <td>{{ $lote->consumo_total_alimento }} kg</td>
                    <td>${{ $lote->costo_total_alimento }}</td>
                    <td>{{ $lote->corral->corral_nombre }}</td>
                    <td>
                        <a class="btn btn-info btn-block" href="{{ route('lote.show', $lote) }}">Detalle</a> 
                        <a class="btn btn-info btn-block" href="{{ route('lote.edit', $lote) }}">Editar</a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
