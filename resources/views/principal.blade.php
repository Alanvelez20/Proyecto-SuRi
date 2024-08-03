@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">ADMINISTRA TU PRODUCCIÓN</h1>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Corrales</h2>
                    <p class="card-text">Administra tus corrales desde aquí. Puedes crear nuevos registros o ver todos los corrales existentes.</p>
                    <a class="btn btn-primary" href="{{ route('menu.corral') }}">Administrar Corrales</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Lotes</h2>
                    <p class="card-text">Administra tus lotes desde aquí. Puedes crear nuevos registros o ver todos los lotes existentes.</p>
                    <a class="btn btn-primary" href="{{ route('menu.lote') }}">Administrar Lotes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Animales</h2>
                    <p class="card-text">Administra tus animales desde aquí. Puedes crear nuevos registros o ver todos los animales existentes.</p>
                    <a class="btn btn-primary" href="{{ route('menu.animal') }}">Administrar Animales</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Alimento</h2>
                    <p class="card-text">Administra tu alimento desde aquí. Puedes crear nuevos registros o ver todos los alimentos existentes.</p>
                    <a class="btn btn-primary" href="{{ route('menu.alimento') }}">Administrar Alimentos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Consumos</h2>
                    <p class="card-text">Administra los consumos desde aquí. Puedes registrar y visualizar todos los consumos realizados.</p>
                    <a class="btn btn-primary" href="{{ route('menu.consumo') }}">Administrar Consumos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-primary">Ventas</h2>
                    <p class="card-text">Administra las ventas desde aquí. Puedes registrar y visualizar todas las ventas realizadas.</p>
                    <a class="btn btn-primary" href="{{ route('menu.venta') }}">Administrar Ventas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
