@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Administración de Consumos</h1>
    
    <div class="text-center mb-4">
        <p class="lead">Aquí puedes capturar y ver los datos de los consumos.</p>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">add_circle_outline</i>
                    <h3 class="card-title text-primary">Capturar Consumo</h3>
                    <p class="card-text">Registra un nuevo consumo.</p>
                    <a class="btn btn-primary" href="{{ route('consumo.create')}}">Capturar Consumo</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">visibility</i>
                    <h3 class="card-title text-primary">Mostrar Datos</h3>
                    <p class="card-text">Visualiza todos los consumos registrados.</p>
                    <a class="btn btn-primary" href="{{ route('consumo.index')}}">Mostrar Datos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
