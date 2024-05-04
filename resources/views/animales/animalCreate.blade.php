@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <form action="{{ route('animal.store') }}" method="POST">
        @csrf
        <label for="animal_especie">Especie</label>
        <input type="text" name="animal_especie" value="{{ old('animal_especie') }}">
        @error('animal_especie')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        
        <label for="animal_genero">Género: </label>
        <select name="animal_genero">
            <option value="Macho" @selected(old('animal_genero') == 'Macho')>Macho</option>
            <option value="Hembra" @selected(old('animal_genero') == 'Hembra')>Hembra</option>
        </select>
        <br>
        
        <label for="animal_peso">Peso: </label>
        <input type="text" name="animal_peso" value="{{ old('animal_peso') }}">
        @error('animal_peso')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="animal_valor_compra">Valor de compra: </label>
        <input type="text" name="animal_valor_compra" value="{{ old('animal_valor_compra') }}">
        @error('animal_valor_compra')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="animal_id_lote">Lote: </label>
        <select name="animal_id_lote">
            @foreach($lotes as $lote)
                <option value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
            @endforeach
        </select>
        @error('animal_id_lote')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <input type="submit" value="Enviar">
    </form>
@endsection
