@extends('components.miLayout')

@section('content')
<h1>Datos de los alimentos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Creado / Enviado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alimentos as $alimento)
                <tr>
                    <td>{{ $alimento->alimento_descripcion }}</td>
                    <td>{{ $alimento->alimento_cantidad }}</td>
                    <td>{{ $alimento->alimento_costo }}</td>
                    <td>{{ $alimento->created_at }}</td>
                    <td>
                        <a class="btn btn-dark btn-block" href="{{ route('alimento.show', $alimento) }}">Detalle</a> 
                        <a class="btn btn-dark btn-block" href="{{ route('alimento.edit', $alimento) }}">Editar</a> 
                        <form action="{{ route('alimento.destroy', $alimento) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-dark btn-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection