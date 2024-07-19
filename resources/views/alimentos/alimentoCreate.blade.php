@extends('components.miLayout')

@section('content')

    @include('parciales.form-error')
    <div class="container">
        <div class="row" >
            <div class="col-sm-6">
                <a href="{{ route('alimento.ShowAgregar') }}">
                    <button type="submit" class="btn btn-primary btn-block">
                     Agregar a inventarios
                    </button>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('alimento.index') }}">
                    <button type="submit" class="btn btn-primary btn-block">
                     Mostrar datos
                    </button>
                </a>
            </div>
        </div><br>
        
        <h1>Crear registro de alimento</h1><br>
        <form action="{{ route('alimento.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="alimento_descripcion">Descripcion: </label>
            <input type="text" class="form-control" name="alimento_descripcion" value="{{ old('alimento_descripcion') }}">
            @error('alimento_descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            
            <label for="alimento_cantidad">Cantidad: </label>
            <input type="text" class="form-control" name="alimento_cantidad" value="{{ old('alimento_cantidad') }}">
            @error('alimento_cantidad')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label for="alimento_costo">Costo por kg: </label>
            <input type="text" class="form-control" name="alimento_costo" value="{{ old('alimento_costo') }}">
            @error('alimento_costo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <hr>
            <input type="file" class="btn btn-dark btn-block" name="archivo">
            <br>
            <input type="submit" class="btn btn-primary" value="Guardar">
            
        </form>
    </div>
@endsection
