<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
    <title>SuRi</title>
    <style>
        h1 {
            color: darkorchid;
        }
        p{
            color: black;
        }
    </style>
</head>
<div class="container mt-4 text-center">
    <h1 class="text-center">Pago Fallido</h1>
    <p>Hubo un problema con tu pago. Por favor, inténtalo de nuevo.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Volver a intentarlo</a>
</div>