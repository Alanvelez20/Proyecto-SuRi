@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Detalles del corral</h1><br>
        <div class="form-group">
            <ul>
                <li>Descripcion: {{ $corral->corral_nombre }}</li>
            </ul>
        </div>
    </div>
@endsection