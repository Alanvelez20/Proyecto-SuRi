<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alimento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #666666;
        }
        .alimento-details {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .alimento-details li {
            list-style: none;
            margin-bottom: 10px;
        }
        .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #f7931e;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            color: #ffffff;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('mainlayout/img/logo.png') }}" alt="Logo" style="display: block; margin: 0 auto; width: 150px;">
        <h1>Hola {{ $user->name }},</h1>
        <p>¡Gracias por registrar un nuevo alimento!</p>
        <div class="alimento-details">
            <p>Aquí están los detalles del alimento:</p>
            <ul>
                <li><span class="icon">🍽️</span> Descripción: {{ $alimento->alimento_descripcion }}</li>
                <li><span class="icon">📦</span> Cantidad: {{ $alimento->alimento_cantidad }}</li>
                <li><span class="icon">💲</span> Costo: {{ $alimento->alimento_costo }}</li>
            </ul>
        </div>
        <p>Puedes contactarnos si necesitas más información.</p>
        <p>¡Que tengas un buen día!</p>
        <img src="{{ asset('mainlayout/img/footer.png') }}" alt="Footer" style="display: block; margin: 20px auto; width: 100%;">
    </div>
</body>
</html>
