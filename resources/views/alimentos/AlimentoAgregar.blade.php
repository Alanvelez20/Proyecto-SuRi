@extends('components.miLayout')

@section('content')
    <h1>Agregar alimento</h1><br>

    @include('parciales.form-error')

    <form method="post" action="{{ route('alimento.AgregarCantidad') }}">
        @csrf
        <div class="form-group">
            <label for="alimento_id">Seleccionar Alimento:</label>
            <select name="alimento_id" id="alimento_id" class="form-control" required>
                <option style="color: black;" value="">Seleccione un alimento</option>
                @foreach($alimentos as $alimento)
                    <option style="color: black;" value="{{ $alimento->id }}">{{ $alimento->alimento_descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="alimento_cantidad">Cantidad (Kg):</label>
            <input type="number" name="alimento_cantidad" class="form-control" id="alimento_cantidad" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="alimento_precio">Costo por Kg:</label>
            <input type="number" name="alimento_precio" class="form-control" id="alimento_precio" step="0.1" required>
        </div>
        <button type="submit" class="btn btn-primary">Añadir cantidad</button>
    </form>
@endsection
