@extends('components.miLayout')

@section('content')
<div class="container">
    <h1 class="text-center">Perfil de Usuario</h1>
    <div class="card">
        <div class="card-header" style="color:blueviolet">
            <h2 >Información del Usuario</h2>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Correo:</strong> {{ $user->email }}</p>
            <p><strong>Plan:</strong> {{ $user->plan }}</p>
            <p><strong>Fecha de expiración de suscripción:</strong> {{ $lastSubDate ? $lastSubDate->format('d-m-Y') : 'No suscrito' }}</p>
            <p><strong>Días Restantes de Suscripción:</strong> {{ $daysRemaining !== null ? $daysRemaining . ' días' : 'No aplicable' }}</p>
        </div>
    </div>
    
    <a class="btn btn-primary" href="/suscripcion">Renovar suscripción</a>

    <!-- Contenedor para los formularios de actualización -->
    <div class="row">
        <!-- Formulario para actualizar el nombre (izquierda) -->
        <div class="col-md-6">
            <h3>Actualizar Nombre</h3>
            <form action="{{ route('user.updateName') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Nombre</button>
            </form>
        </div>

        <!-- Formulario para actualizar la contraseña (derecha) -->
        <div class="col-md-6">
            <h3>Cambiar Contraseña</h3>
            <form action="{{ route('user.updatePassword') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">Contraseña Actual:</label>
                    <input type="password" id="current_password" name="current_password" class="form-control">
                    @error('current_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password">Nueva Contraseña:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control">
                    @error('new_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
            </form>
        </div>
    </div> <!-- Cierre de la fila -->
</div>
@endsection
