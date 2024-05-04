@extends('components.miLayout')

@section('content')
    <h1>Editar lote.</h1>

    @include('parciales.form-error')

    <form action="{{ route('lote.update', $lote) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="lote_nombre">Nombre: </label>
        <input type="text" name="lote_nombre" value="{{ old('lote_nombre') ?? $lote->lote_nombre }}">
        <br>

        

        <label for="lote_id_corral">Corral: </label>
        <select name="lote_id_corral">
            @foreach($corrales as $corral)
                <option value="{{ $corral->id }}" @if($corral->id == $lote->lote_id_corral) selected @endif>
                    {{ $corral->corral_nombre }}
                </option>
            @endforeach
        </select>

        

        <input type="submit" value="Enviar">
    </form>
@endsection