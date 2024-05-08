@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Crear registro de corral</h1><br>
        <form action="{{ route('corral.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="corral_nombre" >Nombre: </label>
                <input type="text" class="form-control" name="corral_nombre" value="{{ old('corral_nombre') }}">
                @error('corral_nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>    
            </div> 
            <div class="form-group">
                <label for="corral_estado">Estado: </label><br>
                <select name="corral_estado" class="form-control">
                    <option style="color: black;" value="Vacío" @selected(old('corral_estado') == 'Vacío')>Vacío</option>
                    <option style="color: black;" value="Ocupado" @selected(old('corral_estado') == 'Ocupado')>Ocupado</option>
                </select>
                <br>
            </div>
            <input type="submit" class="btn btn-dark btn-block" value="Enviar">
        </form>
    </div>
@endsection