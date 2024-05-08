@extends('components.miLayout')

@section('content')
<h1>Datos de los animales</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Especie</th>
                <th>Género</th>
                <th>Peso</th>
                <th>Valor de compra</th>
                <th>Valor de venta</th>
                <th>Numero de lote</th>
                <th>Creado / Enviado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animales as $animal)
                <tr>
                    <td>{{ $animal->animal_especie }}</td>
                    <td>{{ $animal->animal_genero }}</td>
                    <td>{{ $animal->animal_peso }}</td>
                    <td>{{ $animal->animal_valor_compra }}</td>
                    <td>{{ $animal->animal_valor_venta }}</td>
                    <td>{{ $animal->animal_id_lote }}</td>
                    <td>{{ $animal->created_at }}</td>
                    <td>
                        <a class="btn btn-dark btn-block" href="{{ route('animal.show', $animal) }}">Detalle</a> 
                        <a class="btn btn-dark btn-block" href="{{ route('animal.edit', $animal) }}">Editar</a> 
                        <form action="{{ route('animal.destroy', $animal) }}" method="POST">
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
