<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar registro</title>
</head>
<body>
    <a href="{{ route('animal.index') }}">Listado de animales</a>
    <hr>
    <h1>Editar animal</h1>

    @include('parciales.form-error')

    <form action="{{ route('animal.update', $animal) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="animal_especie">Especie</label>
        <input type="text" name="animal_especie" value="{{ old('animal_especie') ?? $animal->animal_especie }}">
        <br>

        <label for="animal_genero">Género</label><br>
        <select name="animal_genero">
            <option value="Macho" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Macho')>Macho</option>
            <option value="Hembra" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Hembra')>Hembra</option>
        </select>

        <label for="animal_peso">Peso</label>
        <input type="text" name="animal_peso" value="{{ old('animal_peso') ?? $animal->animal_peso }}">
        <br>

        <label for="animal_valor_compra">Especie</label>
        <input type="text" name="animal_valor_compra" value="{{ old('animal_valor_compra') ?? $animal->animal_valor_compra }}">
        <br>

        <label for="animal_id_lote">Especie</label>
        <input type="text" name="animal_id_lote" value="{{ old('animal_id_lote') ?? $animal->animal_id_lote }}">
        <br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>