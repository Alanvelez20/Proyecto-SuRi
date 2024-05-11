@extends('components.miLayout')

@section('content')

    <div class="container">
        <div class="row" >
            <div class="col-sm-6">
                <div class="card">
                    <h2>Corrales</h2>
                    <p>Aquí puedes administrar tus corrales.</p>
                    <a class="btn" href="{{ route('corral.create') }}">Crear registro</a>
                    <a class="btn" href="{{ route('corral.index') }}">Mostrar datos</a>
                </div>
                <div class="card">
                    <h2>Lotes</h2>
                    <p>Aquí puedes administrar tus lotes.</p>
                    <a class="btn" href="{{ route('lote.create') }}">Crear registro</a>
                    <a class="btn" href="{{ route('lote.index') }}">Mostrar datos</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <h2>Animales</h2>
                    <p>Aquí puedes administrar tus animales.</p>
                    <a class="btn" href="{{ route('animal.create') }}">Crear registro</a>
                    <a class="btn" href="{{ route('animal.index') }}">Mostrar datos</a>
                </div>
                <div class="card">
                    <h2>Alimento</h2>
                    <p>Aquí puedes administrar tu alimento.</p>
                    <a class="btn" href="{{ route('alimento.create') }}">Crear registro</a>
                    <a class="btn" href="{{ route('alimento.index') }}">Mostrar datos</a>
                </div>
            </div>
        </div>
    </div>

@endsection