@extends('components.miLayout')

@section('content')

@include('parciales.form-error')

<div class="container">
    <h1>Editar Usuario</h1><br>

    <div class="row">
        <!-- Formulario de edición -->
        <div class="col-md-6">
            <div class="form-group">
                <form action="{{ route('user.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') ?? $usuario->name }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="plan">Plan:</label>
                            <select class="form-control" name="plan" id="plan">
                                <option style="color: black" value="Mensual" @selected(old('plan') ?? $usuario->plan == 'Mensual')>Mensual</option>
                                <option style="color: black" value="Anual" @selected(old('plan') ?? $usuario->plan == 'Anual')>Anual</option>
                                <option style="color: black" value="Especial" @selected(old('plan') ?? $usuario->plan == 'Especial')>Especial</option>
                            </select>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </form>
            </div>
        </div>

        <!-- Información no editable en una tarjeta -->
        <div class="col-md-6">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Detalles del Usuario</h5>
                    <p class="card-text"><strong>Nombre:</strong> {{ $usuario->name }}</p>
                    <p class="card-text"><strong>Correo:</strong> {{ $usuario->email }}</p>
                    <p class="card-text"><strong>Suscripción Activa:</strong> {{ $usuario->subscription_active ? 'Sí' : 'No' }}</p>
                    <p class="card-text"><strong>Plan:</strong> {{ $usuario->plan ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Fecha de expiración de suscripción:</strong> {{ $usuario->last_sub_date ? $usuario->last_sub_date->format('d-m-Y') : 'No suscrito' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
