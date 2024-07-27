@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Registrar Consumo de Alimentos</h1>
        <form action="{{ route('consumo.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="lote_id_consumo">Lote</label>
                <select name="lote_id_consumo" id="lote_id_consumo" class="form-control">
                    @foreach($lotes as $lote)
                        <option style="color: black;" value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
                    @endforeach
                </select>
            </div>

            <label for="alimento_id_consumo">Alimento: </label>
            <select name="alimento_id_consumo" class="form-control">
                @foreach($alimentos as $alimento)
                    <option style="color: black;" value="{{ $alimento->id }}">{{ $alimento->alimento_descripcion }}</option>
                @endforeach
            </select>
            @error('alimento_id_consumo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <div>
                <label for="alimento_cantidad_total">Cantidad del alimento</label>
                <input type="number" class="form-control" name="alimento_cantidad_total" value="{{ old('alimento_cantidad_total') }}">
                @error('alimento_cantidad_total')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div>
                <label for="fecha_consumo">Fecha del consumo</label>
                <input type="date" class="form-control" name="fecha_consumo" value="{{ old('fecha_consumo') }}">
                @error('fecha_consumo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <input type="submit" class="btn btn-primary" value="Capturar">

        </form>        
    </div>
@endsection
 