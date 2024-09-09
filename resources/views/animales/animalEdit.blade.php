@extends('components.miLayout')

@section('content')
    

    @include('parciales.form-error')
    <div class="container">
    <h1>Editar datos del animal</h1>
    <form action="{{ route('animal.update', $animal) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="animal_especie">Raza</label>
        <input type="text" class="form-control" name="animal_especie" value="{{ old('animal_especie') ?? $animal->animal_especie }}" required>
        <br>

        <label for="animal_genero">Sexo</label><br>
        <select name="animal_genero" class="form-control" required>
            <option style="color: black;" value="Macho" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Macho')>Macho</option>
            <option style="color: black;" value="Hembra" @selected((old('animal_genero') ?? $animal->animal_genero) == 'Hembra')>Hembra</option>
        </select>
        <br>

        <label for="animal_peso_inicial">Peso inicial (Kg)</label>
        <input type="number" class="form-control" name="animal_peso_inicial" value="{{ old('animal_peso_inicial') ?? $animal->animal_peso_inicial }}" step="0.1" required>
        <br>

        <label for="animal_valor_compra">Precio de compra ($)</label>
        <input type="number" class="form-control" name="animal_valor_compra" value="{{ old('animal_valor_compra') ?? $animal->animal_valor_compra }}" step="0.1" required>
        <br>

        <label for="fecha_ingreso">Fecha de ingreso</label>
        <input type="date" class="form-control" name="fecha_ingreso" value="{{ old('fecha_ingreso') ?? $animal->fecha_ingreso }}" required>
        <br>

        <h2>Actualizar peso Actual (Kg)</h2>
        <div class="mb-3">
            <label for="animal_peso_final" class="form-label">Actualiza el peso del animal</label>
            <div class="input-group">
                <input type="number" class="form-control form-control-lg border-primary font-weight-bold" id="animal_peso_final" name="animal_peso_final" value="{{ old('animal_peso_final') ?? $animal->animal_peso_final }}" step="0.1" required>
                <span class="input-group-text bg-primary text-white">Kg</span>
            </div>
        </div>
        <br>

        

        <button type="submit"  class="btn btn-primary">Guardar</button>
    </form>
    </div>
    <style>
        .font-weight-bold {
            font-size: 1.5rem; 
        }
    </style>
@endsection