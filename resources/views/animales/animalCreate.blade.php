<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar animal</title>
</head>
<body>
    <a href="/principal">Página principal</a>
    <hr>
    <h1>Registrar animal</h1>

    @include('parciales.form-error')

    <form action="{{ route('animal.store') }}" method="POST">
        @csrf
        <label for="animal_especie">Especie</label>
        <input type="text" name="animal_especie" value="{{ old('animal_especie') }}">
        @error('animal_nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        
        <label for="animal_genero">Género</label><br>
        <select name="animal_genero">
            <option value="Macho" @selected(old('animal_genero') == 'Macho')>Macho</option>
            <option value="Hembra" @selected(old('animal_genero') == 'Hembra')>Hembra</option>
        </select>
        <br>
        
        <label for="animal_peso">Peso</label>
        <input type="text" name="animal_peso" value="{{ old('animal_peso') }}">
        @error('animal_peso')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="animal_valor_compra">Valor de compra</label>
        <input type="text" name="animal_valor_compra" value="{{ old('animal_valor_compra') }}">
        @error('animal_valor_compra')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="animal_id_lote">Numero de lote</label>
        <input type="text" name="animal_id_lote" value="{{ old('animal_id_lote') }}">
        @error('animal_id_lote')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>