@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Administración de Alimentos</h1>
    
    <div class="text-center mb-4">
        <p class="lead">Gestiona todo lo relacionado con los alimentos para el ganado. Puedes crear nuevos registros, importar datos, mostrar datos existentes y agregar al inventario.</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">restaurant</i>
                    <h2 class="card-title text-primary">Crear registro</h2>
                    <p class="card-text">Añade nuevos alimentos al sistema.</p>
                    <a class="btn btn-primary" href="{{ route('alimento.create') }}">Crear registro</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">cloud_upload</i>
                    <h2 class="card-title text-primary">Importar datos</h2>
                    <p class="card-text">Importa datos de alimentos desde un archivo.</p>
                    <a class="btn btn-primary" href="{{ route('alimentos.import.form') }}">Importar datos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">visibility</i>
                    <h2 class="card-title text-primary">Mostrar datos</h2>
                    <p class="card-text">Visualiza los registros de alimentos existentes.</p>
                    <a class="btn btn-primary" href="{{ route('alimento.index') }}">Mostrar datos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">add_circle</i>
                    <h2 class="card-title text-primary">Agregar a inventario</h2>
                    <p class="card-text">Agrega alimentos al inventario existente.</p>
                    <a class="btn btn-primary" href="{{ route('alimento.ShowAgregar') }}">Agregar a inventario</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
