@extends('components.miLayout')

@section('content')
    <h1 class="text-center">Corrales</h1><br>
    <div class="text-right">
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#corralModal">
            Crear Corral
        </a>
    </div>
    <br><h2>Datos de los corrales</h2><br>

    

    <div class="modal" id="corralModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear registro de corral</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('parciales.form-error')
                    <form action="{{ route('corral.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label style="color: black" for="corral_nombre">Nombre: </label>
                            <input style="color: black" type="text" id="corralNombre" class="form-control" name="corral_nombre" value="{{ old('corral_nombre') }}" placeholder="Escribe aquí el nombre del corral">
                            @error('corral_nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="form-group">
        <form method="get" action="/search3">
            <div class="input-group">
                <input class="form-control" name="search3" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    <div class="mb-4">
        <a href="{{ route('corral.index') }}" class="btn btn-primary">Reiniciar filtros</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 80%;">Nombre</th> 
                    <th style="width: 20%;">Acciones</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($corrales as $corral)
                    <tr>
                        <td>{{ $corral->corral_nombre }}</td>
                        <td>
                            <a class="btn btn-info btn-block" href="{{ route('corral.edit', $corral) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
