@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Registrar Consumo de Alimentos</h1>
        <form action="{{ route('consumo-alimentos.relacionar-consumo-alimentos') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="lote_id">Lote:</label>
                <select name="lote_id" id="lote_id" class="form-control">
                    @foreach($lotes as $lote)
                        <option style="color: black;" value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="alimento_id">Materia</label>
                <select name="alimento_id[]" id="alimento_id"  multiple>
                    @foreach ($alimentos as $alimento)
                        <option value="{{ $alimento->id }}" @selected(false !== array_search($alimento->id, $lote->alimentos->pluck('id')->toArray()))>{{ $alimento->alimento_descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" class="btn btn-dark btn-block" value="Guardar">

        </form>        
    </div>
@endsection
