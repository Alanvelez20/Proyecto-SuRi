@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Administración de Ventas</h1>
    
    
    <div class="text-center mb-4">
        <p class="lead">Aquí puedes capturar y ver los datos de las ventas.</p>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">add_shopping_cart</i>
                    <h3 class="card-title text-primary">Capturar Venta</h3>
                    <p class="card-text">Registra una nueva venta.</p>
                    <a class="btn btn-primary" href="{{ route('venta.create')}}">Capturar Venta</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">visibility</i>
                    <h3 class="card-title text-primary">Mostrar Datos</h3>
                    <p class="card-text">Visualiza todas las ventas registradas.</p>
                    <a class="btn btn-primary" href="{{ route('venta.index')}}">Mostrar Datos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
