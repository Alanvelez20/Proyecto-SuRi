@extends('components.miLayout')

@section('content')
    @include('parciales.form-error')
    <div class="container">
        <h1>Crear registro de animal</h1><br>
        <form action="{{ route('animal.store') }}" method="POST">
            @csrf

            <label for="arete">Numero de arete </label>
            <input type="number" class="form-control" name="arete" value="{{ old('arete') }}">
            @error('arete')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label for="animal_especie">Especie</label>
            <input type="text" class="form-control" name="animal_especie" value="{{ old('animal_especie') }}">
            @error('animal_especie')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            
            <label for="animal_genero">Género: </label>
            <select name="animal_genero" class="form-control">
                <option style="color: black;" value="Macho" @selected(old('animal_genero') == 'Macho')>Macho</option>
                <option style="color: black;" value="Hembra" @selected(old('animal_genero') == 'Hembra')>Hembra</option>
            </select>
            <br>
            
            <label for="animal_peso_inicial">Peso: </label>
            <input type="number" class="form-control" name="animal_peso_inicial" value="{{ old('animal_peso_inicial') }}">
            @error('animal_peso')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label for="animal_valor_compra">Valor de compra: </label>
            <input type="number" class="form-control" name="animal_valor_compra" value="{{ old('animal_valor_compra') }}">
            @error('animal_valor_compra')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <div>
                <label for="fecha_ingreso">Fecha del ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}">
                @error('fecha_ingreso')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

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

            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>
@endsection
