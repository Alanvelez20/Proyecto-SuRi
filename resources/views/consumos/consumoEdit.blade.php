@extends('components.miLayout')

@section('content')
    <div class="container">
        <h1>Editar Fecha del Consumo</h1><br>

        @include('parciales.form-error')

        <form action="{{ route('consumo.update', $consumo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fecha_consumo">Fecha:</label>
                <input type="date" class="form-control" name="fecha_consumo" value="{{ old('fecha_consumo', $consumo->fecha_consumo) }}">
                @error('fecha_consumo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="Actualizar Fecha">
        </form>
    </div>
@endsection
