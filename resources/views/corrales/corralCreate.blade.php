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
                    <option style="color: black;" value="Engorda" @selected(old('corral_estado') == 'Engorda')>Engorda</option>
                    <option style="color: black;" value="Lactancia" @selected(old('corral_estado') == 'Lactancia')>Lactancia</option>
                    <option style="color: black;" value="Otro" @selected(old('corral_estado') == 'Otro')>Otro</option>
                </select>
                <br>
            </div>
            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>
@endsection