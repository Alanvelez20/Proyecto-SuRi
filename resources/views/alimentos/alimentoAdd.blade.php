@extends('components.miLayout')

@section('content')
    <h1>Añadir cantidad al alimento: {{ $alimento->alimento_descripcion }}</h1><br>

    @include('parciales.form-error')

    <form method="post" action="{{ route('alimento.AddQuantity', $alimento) }}">
        @csrf
        <div class="form-group">
            <label for="alimento_cantidad">Cantidad a añadir:</label>
            <input type="number" name="alimento_cantidad" class="form-control" id="alimento_cantidad" required>
        </div>
        <div class="form-group">
            <label for="alimento_precio">Costo por KG:</label>
            <input type="number" name="alimento_precio" class="form-control" id="alimento_precio" required>
        </div>
        <button type="submit" class="btn btn-primary">Añadir cantidad</button>
    </form>
@endsection
