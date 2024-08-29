@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Alimentos</h1><br>
    <h2>Datos de los alimentos</h2>

    <div class="form-group">
        <form method="get" action="/search4">
            <div class="input-group">
                <input class="form-control" name="search4" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('alimentos.export') }}" class="btn btn-success btn-block">Exportar a Excel</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('alimento.index') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>
                        Cantidad (Kg)
                        <a href="{{ route('alimento.index', ['sort_by' => 'alimento_cantidad', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'alimento_cantidad' ? 'desc' : 'asc']) }}">
                            @if (request('sort_by') == 'alimento_cantidad' && request('sort_direction') == 'asc')
                                &#9650;
                            @elseif (request('sort_by') == 'alimento_cantidad' && request('sort_direction') == 'desc')
                                &#9660;
                            @else
                                &#9650;&#9660;
                            @endif
                        </a>
                    </th>
                    <th>
                        Costo por Kg
                        <a href="{{ route('alimento.index', ['sort_by' => 'alimento_costo', 'sort_direction' => request('sort_direction') == 'asc' && request('sort_by') == 'alimento_costo' ? 'desc' : 'asc']) }}">
                            @if (request('sort_by') == 'alimento_costo' && request('sort_direction') == 'asc')
                                &#9650;
                            @elseif (request('sort_by') == 'alimento_costo' && request('sort_direction') == 'desc')
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
                @foreach ($alimentos as $alimento)
                    <tr>
                        <td>{{ $alimento->alimento_descripcion }}</td>
                        <td>{{ $alimento->alimento_cantidad }} Kg</td>
                        <td>$ {{ $alimento->alimento_costo }}</td>
                        <td>
                            <a class="btn btn-info btn-block" href="{{ route('alimento.show', $alimento) }}">Detalle</a> 
                            <a class="btn btn-info btn-block" href="{{ route('alimento.edit', $alimento) }}">Editar</a> 
                            <a class="btn btn-info btn-block" href="{{ route('alimento.ShowAdd', $alimento) }}">Agregar inventario</a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
