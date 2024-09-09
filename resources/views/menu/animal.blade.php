@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Administración de Animales</h1>

    <div class="text-center mb-4">
        <p class="lead">En esta sección puedes gestionar todos los aspectos relacionados con los animales. Desde la creación de nuevos registros hasta la importación y transferencia de datos.</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">pets</i>
                    <h2 class="card-title text-primary">Crear Registro</h2>
                    <p class="card-text">Registra un nuevo animal en el sistema.</p>
                    <a class="btn btn-primary" href="{{ route('animal.create') }}">Crear Registro</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">file_upload</i>
                    <h2 class="card-title text-primary">Importar Datos</h2>
                    <p class="card-text">Importa datos de animales desde un archivo para añadir múltiples registros de una sola vez.</p>
                    <a class="btn btn-primary" href="{{ route('animales.import.form') }}">Importar Datos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">visibility</i>
                    <h2 class="card-title text-primary">Mostrar Datos</h2>
                    <p class="card-text">Visualiza todos los registros de animales existentes en el sistema.</p>
                    <a class="btn btn-primary" href="{{ route('animal.index') }}">Mostrar Datos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="material-icons md-48" style="font-size: 36px; color:#F2AA1F">swap_horiz</i>
                    <h2 class="card-title text-primary">Realizar Traspaso</h2>
                    <p class="card-text">Gestiona el traspaso de animales entre diferentes corrales o lotes.</p>
                    <a class="btn btn-primary" href="{{ route('traspaso.create') }}">Realizar Traspaso</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
