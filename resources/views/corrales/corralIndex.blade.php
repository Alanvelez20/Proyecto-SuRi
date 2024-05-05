@extends('components.miLayout')

@section('content')
<h1>Datos de corrales</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Creado / Enviado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($corrales as $corral)
                <tr>
                    <td>{{ $corral->corral_nombre }}</td>
                    <td>{{ $corral->corral_estado }}</td>
                    <td>{{ $corral->created_at }}</td>
                    <td>
                        <a href="{{ route('corral.show', $corral) }}">Detalle</a> |
                        <a href="{{ route('corral.edit', $corral) }}">Editar</a> |
                        <form action="{{ route('corral.destroy', $corral) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection