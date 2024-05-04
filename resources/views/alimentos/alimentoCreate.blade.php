@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <form action="{{ route('alimento.store') }}" method="POST">
        @csrf
        <label for="alimento_descripcion">Descripcion: </label>
        <input type="text" name="alimento_descripcion" value="{{ old('alimento_descripcion') }}">
        @error('alimento_descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        
        <label for="alimento_cantidad">Cantidad: </label>
        <input type="text" name="alimento_cantidad" value="{{ old('alimento_cantidad') }}">
        @error('alimento_cantidad')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="alimento_costo">Costo: </label>
        <input type="text" name="alimento_costo" value="{{ old('alimento_costo') }}">
        @error('alimento_costo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <input type="submit" value="Enviar">
    </form>
@endsection
