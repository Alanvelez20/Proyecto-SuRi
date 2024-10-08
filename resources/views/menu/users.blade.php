@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Administración de Usuarios</h1>
    
    <div class="text-center mb-4">
        <p class="lead">Aquí puedes gestionar y ver los usuarios.</p>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">add</i>
                    <h3 class="card-title text-primary">Crear Usuario</h3>
                    <p class="card-text">Registra un nuevo usuario.</p>
                    <a class="btn btn-primary" href="{{ route('user.create') }}">Crear nuevo usuario</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons" style="font-size: 36px; color:#F2AA1F">visibility</i>
                    <h3 class="card-title text-primary">Mostrar datos de usuarios</h3>
                    <p class="card-text">Visualiza todos los usuarios registrados y administra su suscripción.</p>
                    <a class="btn btn-primary" href="{{ route('user.index') }}">Mostrar Usuarios</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection