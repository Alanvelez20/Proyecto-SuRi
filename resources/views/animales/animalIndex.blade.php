<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado Animales</title>
</head>
<body>
    <a href="{{ route('animal.create') }}">Nuevo animal</a>
    <h1>Lista de animales</h1>
    <table border="1">
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
                        <a href="{{ route('animal.show', $animal) }}">Detalle</a> |
                        <a href="{{ route('animal.edit', $animal) }}">Editar</a> |
                        <form action="{{ route('animal.destroy', $animal) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>