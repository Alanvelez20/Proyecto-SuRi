@extends('components.miLayout')

@section('content')
    @include('parciales.form-error')
    <div class="container">
        <h1>Crear usuario</h1><br>
        <a href="{{ route('user.index') }}">
            <button type="button" class="btn btn-primary">
                Volver a la lista de usuarios
            </button>
        </a>
        <br><br>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <label for="name">Nombre de usuario: </label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label for="email">Correo electrónico: </label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            
            <label for="password">Contraseña: </label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
            @error('contraseña')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <label>Suscrito: </label><br>
            <div class="form-check">
                <input  type="radio" name="subscription_active" id="suscrito_si" value="1" @checked(old('subscription_active') == '1')>
                <label  for="suscrito_si">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input  type="radio" name="subscription_active" id="suscrito_no" value="0" @checked(old('subscription_active') == '0')>
                <label  for="suscrito_no">
                    No
                </label>
            </div>
            @error('subscription_active')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <!-- Opciones de plan, se mostrarán solo si "Sí" está seleccionado -->
            <div id="planOptions" style="display: none;">
                <label for="plan">Tipo de plan: </label>
                <select class="form-control" name="plan" id="plan">
                    <option style="color: black" value="Mensual" @selected(old('plan') == 'Mensual')>Mensual</option>
                    <option style="color: black" value="Anual" @selected(old('plan') == 'Anual')>Anual</option>
                    <option style="color: black" value="Especial" @selected(old('plan') == 'Especial')>Especial</option>
                </select>
                @error('plan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const suscritoSi = document.getElementById('suscrito_si');
            const planOptions = document.getElementById('planOptions');

            suscritoSi.addEventListener('change', function () {
                if (suscritoSi.checked) {
                    planOptions.style.display = 'block';
                }
            });

            document.getElementById('suscrito_no').addEventListener('change', function () {
                if (this.checked) {
                    planOptions.style.display = 'none';
                }
            });

            // Mostrar las opciones si "Sí" estaba previamente seleccionado
            if (suscritoSi.checked) {
                planOptions.style.display = 'block';
            }
        });
    </script>
@endsection
