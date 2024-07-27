@extends('components.miLayout')

@section('content')
    

    @include('parciales.form-error')
    <div class="container">
    <h1>Editar datos del animal</h1>
    <form action="{{ route('animal.update', $animal) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="animal_especie">Especie</label>
        <input type="text" class="form-control" name="animal_especie" value="{{ old('animal_especie') ?? $animal->animal_especie }}">
        <br>

        <label for="animal_genero">Género</label><br>
        <select name="animal_genero" class="form-control">
            <option style="color: black;" value="Macho" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Macho')>Macho</option>
            <option style="color: black;" value="Hembra" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Hembra')>Hembra</option>
        </select>

        <label for="animal_peso_final">Peso actual</label>
        <input type="text" class="form-control" name="animal_peso_final" value="{{ old('animal_peso_final') ?? $animal->animal_peso_final }}">
        <br>

        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
    </div>
@endsection