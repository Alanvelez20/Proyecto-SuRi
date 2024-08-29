@extends('components.miLayout')

@section('content')
<h1>Usuarios</h1>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Suscripción Activa</th>
                <th>Tipo de Plan</th>
                <th>Fecha de expiración <br> (Suscripción)</th>
                <th>Activar/Desactivar suscripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->subscription_active ? 'Sí' : 'No' }}</td>
                    <td>{{ $usuario->plan ?? 'N/A' }}</td>
                    <td>{{ $usuario->last_sub_date ? \Carbon\Carbon::parse($usuario->last_sub_date)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        <form action="{{ route('usuarios.toggleSubscription', $usuario) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label class="switch">
                                <input type="checkbox" name="suscrito" onchange="this.form.submit()" {{ $usuario->subscription_active ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </form>
                    </td>
                    <td>
                        <a class="btn btn-info btn-block" href="{{ route('user.edit', $usuario) }}">Editar</a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
