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

        <label for="animal_peso">Peso</label>
        <input type="text" class="form-control" name="animal_peso" value="{{ old('animal_peso') ?? $animal->animal_peso }}">
        <br>

        <label for="animal_valor_compra">Especie</label>
        <input type="text" class="form-control" name="animal_valor_compra" value="{{ old('animal_valor_compra') ?? $animal->animal_valor_compra }}">
        <br>

        <label for="animal_id_lote">Lote: </label>
            <select name="animal_id_lote" class="form-control">
                @foreach($lotes as $lote)
                    <option style="color: black;" value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
                @endforeach
            </select>
            @error('animal_id_lote')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

        <input type="submit" class="btn btn-dark btn-block" value="Enviar">
    </form>
    </div>
@endsection