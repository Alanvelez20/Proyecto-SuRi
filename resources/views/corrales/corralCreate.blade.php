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
            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>
@endsection