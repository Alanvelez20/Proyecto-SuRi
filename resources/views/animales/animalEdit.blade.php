@extends('components.miLayout')

@section('content')
    

    @include('parciales.form-error')
    <div class="container">
    <h1>Editar datos del animal</h1>
    <form action="{{ route('animal.update', $animal) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="animal_especie">Especie</label>
        <input type="text" class="form-control" name="animal_especie" value="{{ old('animal_especie') ?? $animal->animal_especie }}" required>
        <br>

        <label for="animal_genero">Género</label><br>
        <select name="animal_genero" class="form-control" required>
            <option style="color: black;" value="Macho" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Macho')>Macho</option>
            <option style="color: black;" value="Hembra" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Hembra')>Hembra</option>
        </select>
        <br>

        <h3>Peso Actual (kg)</h3>
        <div class="mb-3">
            <label for="animal_peso_final" class="form-label">Actualiza el peso del animal</label>
            <div class="input-group">
                <input type="number" class="form-control form-control-lg border-primary font-weight-bold" id="animal_peso_final" name="animal_peso_final" value="{{ old('animal_peso_final') ?? $animal->animal_peso_final }}" required>
                <span class="input-group-text bg-primary text-white">kg</span>
            </div>
        </div>
        <br>

        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
    </div>
    <style>
        .font-weight-bold {
            font-size: 1.5rem; 
        }
    </style>
@endsection