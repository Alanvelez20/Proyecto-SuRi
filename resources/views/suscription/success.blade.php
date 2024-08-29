<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('MainLayout/template/img/logo.ico') }}">
    <title>SURI</title>
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
    <h1 class=" text-center">¡Pago Exitoso!</h1>
    <p>Tu suscripción ha sido activada. ¡Gracias por tu compra!</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
</div>