<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
</head>

<body>
    <a href="{{route('animal.create')}}">Crear registro</a>
    <hr>
    <h1>Información</h1>

    {{ $tipo }}


    @if ($tipo == 'alumno')
        <h2>Alumnos</h2>
        <p>texto</p>
    @elseif($tipo == 'prof' || $tipo == 'profesor')
        <h2>Profesores</h2>
        <p>mas texto</p>
    @else
        <h2>Página principal</h2>
    @endif

</body>

</html>