@extends('components.miLayout')

@section('content')
    <h1>Editar corral.</h1>

    @include('parciales.form-error')

    <form action="{{ route('corral.update', $corral) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="corral_nombre">Nombre: </label>
        <input type="text" name="corral_nombre" value="{{ old('corral_nombre') ?? $corral->corral_nombre }}">
        <br><br>
        
        <p>Estado: {{ $corral->corral_estado }}</p>
        <br>

        <input type="submit" value="Enviar">
    </form>
@endsection