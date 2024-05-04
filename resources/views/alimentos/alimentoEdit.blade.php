@extends('components.miLayout')

@section('content')
    <h1>Editar alimento</h1>

    @include('parciales.form-error')

    <form action="{{ route('alimento.update', $alimento) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="alimento_descripcion">Especie</label>
        <input type="text" name="alimento_descripcion" value="{{ old('alimento_descripcion') ?? $alimento->alimento_descripcion }}">
        <br>

        <label for="alimento_cantidad">Peso</label>
        <input type="text" name="alimento_cantidad" value="{{ old('alimento_cantidad') ?? $alimento->alimento_cantidad }}">
        <br>

        <label for="alimento_costo">Especie</label>
        <input type="text" name="alimento_costo" value="{{ old('alimento_costo') ?? $alimento->alimento_costo }}">
        <br>

        <input type="submit" value="Enviar">
    </form>
@endsection