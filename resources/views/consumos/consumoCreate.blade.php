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
            
            <div>
                <label for="alimento_descripcion">Nombre del alimento</label>
                <input type="text" class="form-control" name="alimento_descripcion" value="{{ old('alimento_descripcion') }}">
                @error('alimento_descripcion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div>
                <label for="alimento_cantidad_total">Cantidad del alimento</label>
                <input type="number" class="form-control" name="alimento_cantidad_total" value="{{ old('alimento_cantidad_total') }}">
                @error('alimento_cantidad_total')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div>
                <label for="valor_dieta">Costo de la dieta</label>
                <input type="number" class="form-control" name="valor_dieta" value="{{ old('valor_dieta') }}">
                @error('valor_dieta')
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

            <div>
                <label for="hora_consumo">Horario </label>
                <select name="hora_consumo" class="form-control">
                    <option style="color: black;" value="AM" @selected(old('hora_consumo') == 'AM')>AM</option>
                    <option style="color: black;" value="PM" @selected(old('hora_consumo') == 'PM')>PM</option>
                </select>
                <br>
            </div>

            <input type="submit" class="btn btn-dark btn-block" value="Guardar">

        </form>        
    </div>
@endsection
 