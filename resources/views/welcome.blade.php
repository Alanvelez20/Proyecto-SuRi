<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SuRi</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('mainlayout/img/logo.png') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('MainLayout/template/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="/" class="navbar-brand px-lg-4 m-0">
                <img src="{{ asset('mainlayout/img/logo.png') }}" alt="Logo" style="width: 5vmax; height: 5 vmax;">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/principal') }}" class="nav-item nav-link">Página Principal</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Log Out</button>
                                  </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-item nav-link">Iniciar sesión</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-item nav-link">Registrar</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('MainLayout\template\img\carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-warning font-weight-medium m-0">Controlador de ganado</h2>
                        <h1 class="display-1 text-white m-0">SURI</h1>
                        <h2 class="text-white m-0">Sistema de Uso de Raciones Integrales</h2>
                        <h3 class="text-white m-0">* DESDE 2024 *</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('MainLayout\template\img\carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-warning font-weight-medium m-0">Controlador de ganado</h2>
                        <h1 class="display-1 text-white m-0">SURI</h1>
                        <h2 class="text-white m-0">Sistema de Uso de Raciones Integrales</h2>
                        <h2 class="text-white m-0">* DESDE 2024 *</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


   <!-- Service Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Nuestros servicios</h4>
            <h1 class="display-4">Podrás controlar los registros en tu rancho</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h4><i class="fa fa-home service-icon"></i>Corrales y lotes</h4>
                        <p class="m-0">Todo rancho cuenta con distintos corrales y lotes, registra tus corrales y asociales un lote 
                            de manera personalizada para tener visión de cada uno de tus animales.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h4><i class="fa fa-paw service-icon"></i>Animales</h4>
                        <p class="m-0">En nuestra sección de animales se pueden registrar a todos los animales que se manejen en tu rancho, incluyendo compras
                            o nacimientos nuevos, los puedes asociar a un lote para que controles donde se encuentra cada uno de tus animales. También 
                            te permitirá controlar su consumo gracias a nuestras tablas y resumenes de información de cada animal.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h4><i class="fa fa-leaf service-icon"></i>Alimentos</h4>
                        <p class="m-0">Cada que compres alimento para tu ganado podrás registrarlo en nuestra aplicación, este aumentará
                            en tu inventario y podrás controlar las cantidades de alimento que se consumen para tener tu inventario siempre actualizado.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h4><i class="fa fa-table service-icon"></i>Consumo</h4>
                        <p class="m-0">Podrás registrar y controlar el consumo de los alimentos en cada lote, así como revisar los resumenes para llevar un mejor
                            control de cada consumo en los animales, controlar como reduce tu inventario de alimentos y los gastos en alimentos individualmente o por lotes.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h4><i class="fa fa-money-bill service-icon"></i>Ventas</h4>
                        <p class="m-0">Registra y controla las ventas de tus animales de una manera rápida y sencilla. Lleva un seguimiento detallado de cada transacción.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Service End -->







    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-4 col-md-4 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Acerca de nosotros</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Guadalajara, Jalisco, MX.</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+52 3312550970</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>surimx2024@gmail.com</p>
            </div>
            <div class="col-lg-4 col-md-4 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Síguenos</h4>
                <p>Siguenos en nuestras redes sociales</p>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" target="blank"  href="https://www.facebook.com/profile.php?id=61565158437923&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" target="blank" href="https://www.instagram.com/suri.mx"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Contáctanos</h4>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Correo" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="3" placeholder="Mensaje" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="/">SuRi</a>. All Rights Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold" target="blank" href="https://github.com/Alanvelez20">Alan Velez</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
