@extends('components.miLayout')

@section('content')
<h1>Listado de lotes</h1>
    @include('parciales.form-error')
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        @foreach ($lotes as $lote)
            <tr>
                <td>{{ $lote->lote_nombre }}</td>
                <td>
                <a href="{{ route('consumo_alimentos.consumo-alimentos', $lote) }}">Generar consumo</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
