@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Editar datos del alimento</h1><br>
        <form action="{{ route('alimento.update', $alimento) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="alimento_descripcion">Nombre</label>
            <input type="text" class="form-control" name="alimento_descripcion" value="{{ old('alimento_descripcion') ?? $alimento->alimento_descripcion }}">
            <br>

            <label for="alimento_cantidad">Cantidad (Kg)</label>
            <p> {{ $alimento->alimento_cantidad }} Kg</p>
            <br>

            <label for="alimento_costo">Costo por Kg</label>
            <p>$ {{  $alimento->alimento_costo }}</p>
            <br>

            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>
@endsection