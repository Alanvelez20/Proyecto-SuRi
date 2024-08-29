<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SURI</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
        <link rel="icon" type="image/x-icon" href="{{ asset('MainLayout/template/img/logo.ico') }}">

    </head>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Figtree', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8fafc; /* Ajusta el color de fondo si es necesario */
        }

        .font-sans {
            max-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            background: #ffffff; /* Ajusta el color de fondo del contenido si es necesario */
            border-radius: 8px; /* Opcional: Añade bordes redondeados al contenedor */
           
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Opcional: Añade sombra al contenedor */
        }
        .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group input[type="checkbox"] {
        width: auto;
        margin-right: 10px;
    }

    .form-group .checkbox-label {
        display: flex;
        align-items: center;
    }

    .form-group .checkbox-label span {
        font-size: 14px;
        color: #666;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-actions a {
        color: #f09475;
        text-decoration: none;
    }

    .form-actions a:hover {
        text-decoration: underline;
    }

    .form-actions .btn {
        background-color: #f96433;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-actions .btn:hover {
        background-color: #f09475 ;
    }

    /* Estilo para el logo */
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    /*Register*/
    button {
    width: 100%;
    padding: 10px;
    background-color: #f96433;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #f09475;
}

/* Estilo para los enlaces */
a {
    color: #f09475;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="checkbox"] {
    margin-right: 10px;
}


    </style>
    <body>
        <div class="font-sans antialiased">
            {{ $slot }}
        </div>

    </body>
</html>
