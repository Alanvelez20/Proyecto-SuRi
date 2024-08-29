@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Lotes</h1><br>

    <div class="text-right">
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#loteModal">
            Crear Lote
        </a>
    </div>

    <div class="modal" id="loteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear registro de lote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('parciales.form-error')
                    <form action="{{ route('lote.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label style="color: black" for="lote_nombre">Nombre:</label>
                            <input style="color: black" type="text" id="loteNombre" class="form-control" name="lote_nombre" value="{{ old('lote_nombre') }}" placeholder="Escribe aquí el nombre del lote">
                            @error('lote_nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label style="color: black" for="lote_id_corral">Corral:</label>
                            <select style="color: black" id="loteIdCorral" class="form-control" name="lote_id_corral">
                                @foreach($corrales as $corral)
                                    <option value="{{ $corral->id }}">{{ $corral->corral_nombre }}</option>
                                @endforeach
                            </select>
                            @error('lote_id_corral')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
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
                    <h5 class="card-title">Cantidad total de alimento consumido</h5>
                    <p class="card-text">{{ $totalConsumoAlimento }} Kg</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Costo total del alimento</h5>
                    <p class="card-text">$ {{ $totalCostoAlimento }}</p>
                </div>
            </div>
        </div>
    </div>
    <h2>Datos de los lotes</h2>
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('lotes.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('lote.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Lote</th>
                    <th>
                        Cantidad de <br>animales
                    </th>
                    <th>
                        Consumo total de alimento
                    </th>
                    <th>
                        Costo total de alimento
                    </th>
                    <th>
                        <form method="GET" action="{{ route('lote.index') }}" style="display:inline;">
                            <input type="hidden" name="lote_filter" value="{{ request('lote_filter') }}">
                            <select name="corral_filter" onchange="this.form.submit()" class="form-control" style="display: inline; width: auto;">
                                <option style="color: black" value="">Corral ᐁ</option>
                                @foreach ($corrales as $corral)
                                    <option style="color: black" value="{{ $corral->id }}" {{ request('corral_filter') == $corral->id ? 'selected' : '' }}>
                                        {{ $corral->corral_nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lotes as $lote)
                    <tr>
                        <td>{{ $lote->lote_nombre }}</td>
                        <td>{{ $lote->lote_cantidad }}</td>
                        <td>{{ $lote->consumo_total_alimento }} Kg</td>
                        <td>$ {{ $lote->costo_total_alimento }}</td>
                        <td>{{ $lote->corral->corral_nombre }}</td>
                        <td>
                            <a class="btn btn-info btn-block" href="{{ route('lote.show', $lote) }}">Detalle</a> 
                            <a class="btn btn-info btn-block" href="{{ route('lote.edit', $lote) }}">Editar</a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
