@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Editar lote</h1><br>
        <form action="{{ route('lote.update', $lote) }}" method="POST">
            @csrf
            @method('PATCH')

            <label for="lote_nombre">Nombre: </label>
            <input type="text" class="form-control" name="lote_nombre" value="{{ old('lote_nombre') ?? $lote->lote_nombre }}">
            <br>

            <label for="lote_id_corral">Cambiar corral: </label>
            <select name="lote_id_corral" class="form-control">
                @foreach($corrales as $corral)
                    <option style="color: black;" value="{{ $corral->id }}" @if($corral->id == $lote->lote_id_corral) selected @endif>
                        {{ $corral->corral_nombre }}
                    </option>
                @endforeach
            </select>
            <br>

            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>
@endsection