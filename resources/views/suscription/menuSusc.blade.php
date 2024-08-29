<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('MainLayout/template/img/logo.ico') }}">
    <title>SURI</title>
    <style>
        h1 {
            color: darkorchid;
        }

        h2 {
            color: darkorchid;
        }

        h3 {
            color: darkorchid;
        }

        p {
            color: #000000;
            font-size: 17px;
        }
        label{
            color: #000000;
        }
        .custom-file-styled {
        position: relative;
        border: 2px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
        background-color: #f8f9fa;
    }

    .custom-file-styled .custom-file-label {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #495057;
    }

    .custom-file-styled .custom-file-label i {
        margin-right: 8px;
        color: darkorchid;
    }

    .custom-file-styled:hover {
        background-color: #e9ecef;
        border-color: darkorchid;
    }
    </style>
</head>

<body class="white-edition">
    <div class="container mt-4">
        <a href="/" class="btn btn-primary">Volver al menú</a>
        <h1 class="mb-4 text-center">¡Suscríbete!</h1>
        <p class="lead text-center">Selecciona el plan que mejor se adapte a tus necesidades y procede al pago.</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h2 class="card-title text-primary">Beneficios</h2>
                        <p class="card-text">
                            • Crea corrales para controlar la ubicación de tus animales. <br>
                            • Crea lotes y visualiza el consumo de alimentos de los animales en el lote.<br>
                            • Registra a todos tus animales, así como podrás observar su información de consumo, costos,
                            peso, entre otras, además de contar con gráficas y resúmenes de información.<br>
                            • Administra tu inventario de todos los alimentos que consumen tus animales.<br>
                            • Genera reportes diarios del alimento que consumen tus animales, lo cual decrementa el 
                            inventario de tus alimentos y lleva el control del mismo.<br>
                            • Administra las ventas de tus animales y observa las ganancias que se obtuvieron con resúmenes
                            y gráficas integradas.<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <form action="{{ route('suscripcion.procesar') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <i class="material-icons md-48" style="font-size: 36px; color:darkorchid">calendar_today</i>
                            <h2 class="card-title text-primary">Mensual</h2>
                            <h2>$200.00 mxn</h2>
                            <input type="radio" name="plan" value="mensual" id="mensual" required>
                            <label for="mensual">Seleccionar este plan</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <i class="material-icons md-48" style="font-size: 36px; color:darkorchid">event</i>
                            <h2 class="card-title text-primary">Anual</h2>
                            <h2>$1200.00 mxn</h2>
                            <input type="radio" name="plan" value="anual" id="anual" required>
                            <label for="anual">Seleccionar este plan</label>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Proceder al Pago</button><br>
            </div>
        </form>
    </div>
    <br> <hr>
    <h2 class="mb-4 text-center">Otros métodos de pago</h2>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <i class="material-icons md-48" style="font-size: 36px; color:darkorchid">compare_arrows</i>
                        <h2 class="card-title text-primary">Transferencia</h2>
                        <p class="card-text">Puedes realizar una transferencia bancaria, depósitos bancarios, así como realizar depósitos en tiendas de autoservicio. Oprime el botón para ver los datos de la cuenta a transferir.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal">
                            Mostrar datos
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <i class="material-icons md-48" style="font-size: 36px; color:darkorchid">attach_money</i>
                        <h2 class="card-title text-primary">Comprobación de pago</h2>
                        <p class="card-text">Si ya realizaste tu pago por un método de pago como puede ser efectivo, 
                            transferencia o depósito de alguna manera, debes enviar la comprobación de tu pago en el 
                            siguiente formulario para activar tu cuenta.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contactModal">
                            Abrir formulario
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar la imagen -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="imageModalLabel">Datos de la cuenta</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body text-center">
            <img src="{{ asset('MainLayout\template\img\pago.png') }}" alt="Datos de la cuenta" class="img-fluid">
            </div>
        </div>
        </div>
    </div>

    <!-- Modal para el formulario de contacto -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Enviar Formulario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('suscription.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Adjuntar imagen</label>
                            <div class="custom-file custom-file-styled">
                                <input type="file" class="custom-file-input" id="archivo" name="archivo" required>
                                <label class="custom-file-label" for="archivo"><i class="fas fa-upload"></i> Selecciona una imagen</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-auto">
        

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="text-dark" href="#">SuRi.com.mx</a>
        </div>
    </footer>

</body>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e){
        var fileName = document.getElementById("archivo").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>

</html>
