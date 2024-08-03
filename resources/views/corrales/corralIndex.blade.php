@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Corrales</h1><br>
    <h2>Datos de los corrales</h2>
    

    <div class="form-group">
        <form method="get" action="/search3">
            <div class="input-group">
                <input class="form-control" name="search3" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    <div class="mb-4">
        <a href="{{ route('corral.index') }}" class="btn btn-primary">Reiniciar filtros</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 80%;">Nombre</th> 
                <th style="width: 20%;">Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($corrales as $corral)
                <tr>
                    <td>{{ $corral->corral_nombre }}</td>
                    <td>
                        <a class="btn btn-info btn-block" href="{{ route('corral.show', $corral) }}">Detalle</a>
                        <a class="btn btn-info btn-block" href="{{ route('corral.edit', $corral) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
