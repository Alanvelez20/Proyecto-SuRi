@extends('components.miLayout')

@section('content')
    <h1>Datos de lotes</h1><br>

    <div class="form-group">
        <form method="get" action="/search2">
            <div class="input-group">
                <input class="form-control" name="search2" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>
                    Cantidad
                    <a href="{{ route('lote.index', ['sort_by' => 'lote_cantidad', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'lote_cantidad' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'lote_cantidad' && request('sort_direction') == 'asc')
                            &#9650; 
                        @elseif (request('sort_by') == 'lote_cantidad' && request('sort_direction') == 'desc')
                            &#9660; 
                        @else
                            &#9650;&#9660; 
                        @endif
                    </a>
                </th>
                <th>
                    Consumo total de alimento
                    <a href="{{ route('lote.index', ['sort_by' => 'consumo_total_alimento', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'consumo_total_alimento' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'consumo_total_alimento' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'consumo_total_alimento' && request('sort_direction') == 'desc')
                            &#9660; 
                        @else
                            &#9650;&#9660; 
                        @endif
                    </a>
                </th>
                <th>
                    Costo total de alimento
                    <a href="{{ route('lote.index', ['sort_by' => 'costo_total_alimento', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'costo_total_alimento' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'costo_total_alimento' && request('sort_direction') == 'asc')
                            &#9650;
                        @elseif (request('sort_by') == 'costo_total_alimento' && request('sort_direction') == 'desc')
                            &#9660; 
                        @else
                            &#9650;&#9660; 
                        @endif
                    </a>
                </th>
                <th>
                    Corral
                    <a href="{{ route('lote.index', ['sort_by' => 'lote_id_corral', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'lote_id_corral' ? 'desc' : 'asc']) }}">
                        @if (request('sort_by') == 'lote_id_corral' && request('sort_direction') == 'asc')
                            &#9650; 
                        @elseif (request('sort_by') == 'lote_id_corral' && request('sort_direction') == 'desc')
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
            @foreach ($lotes as $lote)
                <tr>
                    <td>{{ $lote->lote_nombre }}</td>
                    <td>{{ $lote->lote_cantidad }}</td>
                    <td>{{ $lote->consumo_total_alimento }}</td>
                    <td>{{ $lote->costo_total_alimento }}</td>
                    <td>{{ $lote->corral->corral_nombre }}</td>
                    <td>
                        <a class="btn btn-dark btn-block" href="{{ route('lote.show', $lote) }}">Detalle</a> 
                        <a class="btn btn-dark btn-block" href="{{ route('lote.edit', $lote) }}">Editar</a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
