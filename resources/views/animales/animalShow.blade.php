<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle del animal</title>
</head>
<body>
    <h1>Detalle del animal</h1>

    <ul>
        <li>Especie: {{ $animal->animal_especie }}</li>
        <li>Género: {{ $animal->animal_genero }}</li>
        <li>Peso: {{ $animal->animal_peso }}</li>
        <li>Valor de compra: {{ $animal->animal_valor_compra }}</li>
        <li>Valor de venta: {{ $animal->animal_valor_venta }}</li>
        <li>Lote: {{ $animal->animal_id_lote }}</li>
    </ul>

</body>
</html>