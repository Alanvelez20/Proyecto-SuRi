@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Menú de Corrales</h1>

    <div class="text-center mb-4">
        <p class="lead">Aquí puedes gestionar y ver los datos de los corrales.</p>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:darkorchid">add</i>
                    <h3 class="card-title text-primary">Crear Registro</h3>
                    <p class="card-text">Registra un nuevo corral.</p>
                    <a class="btn btn-primary" href="{{ route('corral.create') }}">Crear Registro</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:darkorchid">visibility</i>
                    <h3 class="card-title text-primary">Mostrar Datos</h3>
                    <p class="card-text">Visualiza todos los corrales registrados.</p>
                    <a class="btn btn-primary" href="{{ route('corral.index') }}">Mostrar Datos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
