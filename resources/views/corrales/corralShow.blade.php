@extends('components.miLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles del Corral</h1>

    <!-- Información del Corral -->
    <div class="card">
        <div class="card-header">
            <h3>Detalles del Corral</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del corral</h5>
                            <p class="card-text">{{ $corral->corral_nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
