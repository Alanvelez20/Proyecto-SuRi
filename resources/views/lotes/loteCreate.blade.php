@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <form action="{{ route('lote.store') }}" method="POST">
        @csrf
        <label for="lote_nombre">Nombre: </label>
        <input type="text" name="lote_nombre" value="{{ old('lote_nombre') }}">
        @error('lote_nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        
        <label for="lote_id_corral">Corral: </label>
        <select name="lote_id_corral">
            @foreach($corrales as $corral)
                <option value="{{ $corral->id }}">{{ $corral->corral_nombre }}</option>
            @endforeach
        </select>
        @error('lote_id_corral')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>


        <input type="submit" value="Enviar">
    </form>
@endsection