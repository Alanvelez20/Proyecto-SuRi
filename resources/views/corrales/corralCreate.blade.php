@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <form action="{{ route('corral.store') }}" method="POST">
        @csrf
        <label for="corral_nombre">Nombre: </label>
        <input type="text" name="corral_nombre" value="{{ old('corral_nombre') }}">
        @error('corral_nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>     

        <label for="corral_estado">Estado: </label><br>
        <select name="corral_estado">
            <option value="Vacío" @selected(old('corral_estado') == 'Vacío')>Vacío</option>
            <option value="Ocupado" @selected(old('corral_estado') == 'Ocupado')>Ocupado</option>
        </select>
        <br>

        <input type="submit" value="Enviar">
    </form>
@endsection