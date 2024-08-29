@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <div class="row" >
            <div class="col-sm-4">
                <a href="{{ route('alimento.ShowAgregar') }}">
                    <button type="submit" class="btn btn-primary btn-block">
                     Agregar alimento a inventarios
                    </button>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('alimento.index') }}">
                    <button type="submit" class="btn btn-primary btn-block">
                     Mostrar datos
                    </button>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('alimentos.import.form') }}">
                    <button type="submit" class="btn btn-primary btn-block">
                     Importar datos
                    </button>
                </a>
            </div>
        </div><br>
        
        <h1>Crear registro de alimento</h1><br>
        <form action="{{ route('alimento.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="alimento_descripcion">Nombre: </label>
            <input type="text" class="form-control" name="alimento_descripcion" value="{{ old('alimento_descripcion') }}" required>
            @error('alimento_descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            
            <label for="alimento_cantidad">Cantidad (Kg): </label>
            <input type="number" class="form-control" name="alimento_cantidad" value="{{ old('alimento_cantidad') }}" step="0.1" required>
            @error('alimento_cantidad')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label for="alimento_costo">Costo por Kg: </label>
            <input type="number" class="form-control" name="alimento_costo" value="{{ old('alimento_costo') }}" step="0.1" required>
            @error('alimento_costo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <label for="archivo">Imagen del alimento (opcional): </label><br>
            <input type="file" class="btn btn-primary " name="archivo">
            <br><br><br>
            <input type="submit" class="btn btn-primary" value="Guardar">
            
        </form>
    </div>
@endsection
