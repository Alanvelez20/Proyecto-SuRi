@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Editar datos del alimento</h1><br>
        <form action="{{ route('alimento.update', $alimento) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="alimento_descripcion">Descripcion</label>
            <input type="text" class="form-control" name="alimento_descripcion" value="{{ old('alimento_descripcion') ?? $alimento->alimento_descripcion }}">
            <br>

            <label for="alimento_cantidad">Cantidad</label>
            <input type="text" class="form-control" name="alimento_cantidad" value="{{ old('alimento_cantidad') ?? $alimento->alimento_cantidad }}">
            <br>

            <label for="alimento_costo">Costo</label>
            <input type="text" class="form-control" name="alimento_costo" value="{{ old('alimento_costo') ?? $alimento->alimento_costo }}">
            <br>

            <input type="submit" value="Enviar">
        </form>
    </div>
@endsection