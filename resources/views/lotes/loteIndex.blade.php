@extends('components.miLayout')

@section('content')
<h1>Datos de lotes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Corral</th>
                <th>Creado / Enviado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lotes as $lote)
                <tr>
                    <td>{{ $lote->lote_nombre }}</td>
                    <td>{{ $lote->lote_cantidad }}</td>
                    <td>{{ $lote->lote_id_corral }}</td>
                    <td>{{ $lote->created_at }}</td>
                    <td>
                        <a href="{{ route('lote.show', $lote) }}">Detalle</a> |
                        <a href="{{ route('lote.edit', $lote) }}">Editar</a> |
                        <form action="{{ route('lote.destroy', $lote) }}" method="POST">
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