@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <h1>Editar corral</h1><br>
        <div class="form-group">
            <form action="{{ route('corral.update', $corral) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="corral_nombre">Nombre: </label>
                <input type="text" name="corral_nombre" class="form-control" value="{{ old('corral_nombre') ?? $corral->corral_nombre }}">
                <br><br>
                

                <input type="submit" class="btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
@endsection