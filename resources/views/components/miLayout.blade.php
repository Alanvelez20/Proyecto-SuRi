<!doctype html>
<html lang="en">

<head>
  <title>SURI</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (antes de cerrar el body) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<link rel="icon" type="image/x-icon" href="{{ asset('MainLayout/template/img/logo.ico') }}">

  <!-- Material Kit CSS -->
  <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
</head>

<body class="dark-edition"> 
  <div class="wrapper ">

    <header class="header">
      <div class="container-fluid">
        <nav class="float-right">
          <ul>
            <li>
              <a class="btn btn-primary" href="{{asset('principal')}}"> Menú Principal </a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button type="submit" class="btn btn-primary btn-block">Log Out</button>
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    
    <div class="sidebar" data-color="purple" data-background-color="black">
      <div class="logo">
        <a href="{{ route('user.profile') }}" class="simple-text logo-normal">
          <img src="{{ asset('MainLayout\template\img\logo.png') }}" alt="Logo" width="30px" height="30px"><br>usuario <br>
          {{ Auth::user()->name }} 
        </a>
      </div>
      @if(auth()->user()->rol == 'admin')
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.users') }}" >
              <i class="material-icons">layers</i>
              <p>Usuarios</p>
            </a>
            <ul class="expanded-options">
              <li><a href="{{ route('user.create') }}">Crear usuario</a></li>
              <li><a href="{{ route('user.index') }}">Mostrar usuarios</a></li>
            </ul>
          </li>
        </ul>
      @else
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.corral') }}">
                <i class="material-icons">home</i>
                <p>Corrales</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('corral.create') }}">Crear registro</a></li>
                <li><a href="{{ route('corral.index') }}">Mostrar datos</a></li>
              </ul>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.lote') }}" >
                <i class="material-icons">layers</i>
                <p>Lotes</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('lote.create') }}">Crear registro</a></li>
                <li><a href="{{ route('lote.index') }}">Mostrar datos</a></li>
              </ul>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.animal') }}">
                <i class="material-icons">pets</i>
                <p>Animales</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('animal.create') }}">Crear registro</a></li>
                <li><a href="{{ route('animales.import.form') }}">Importar datos</a></li>
                <li><a href="{{ route('animal.index') }}">Mostrar datos</a></li>
                <li><a href="{{ route('traspaso.create') }}">Realizar traspaso</a></li>
              </ul>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.alimento') }}">
                <i class="material-icons">grass</i>
                <p>Alimento</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('alimento.create') }}">Crear registro</a></li>
                <li><a href="{{ route('alimentos.import.form') }}">Importar datos</a></li>
                <li><a href="{{ route('alimento.index') }}">Mostrar datos</a></li>
                <li><a href="{{ route('alimento.ShowAgregar') }}">Agregar a inventario</a></li>
              </ul>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.consumo') }}">
                <i class="material-icons">restaurant</i>
                <p>Consumo de alimentos</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('consumo.create')}}">Capturar consumo</a></li>
                <li><a href="{{route('consumo.index')}}">Mostrar datos</a></li>
              </ul>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('menu.venta') }}" >
                <i class="material-icons">shopping_cart</i>
                <p>Venta de animal</p>
              </a>
              <ul class="expanded-options">
                <li><a href="{{ route('venta.create')}}">Capturar venta</a></li>
                <li><a href="{{route('venta.index')}}">Mostrar datos</a></li>
              </ul>
            </li>
          </ul>
        </div>
      @endif
    </div>
    <button id="toggleSidebar" class="toggle-btn">☰</button>

    <div class="main-panel">     
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          @yield('content')

          <!--/cointainer-fluid-->
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container-fluid">
        <nav class="float-right">
          <ul>
            <li>
              <a class="btn btn-primary" href="{{asset('principal')}}"> Menú Principal </a>
            </li>
            <li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button type="submit" class="btn btn-primary btn-block">Log Out</button>
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('js/core/jquery.min.js')}}"></script>
  <script src="{{asset('js/core/popper.min.js')}}"></script>
  <script src="{{asset('js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

  
  <script src="https://unpkg.com/default-passive-events"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="{{asset('js/plugins/chartist.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>
  <script src="{{asset('js/material-dashboard.js?v=2.1.0')}}"></script>
  <script src="{{asset('demo/demo.js')}}"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        /*let touchStartX = 0;
        let touchEndX = 0;
        const swipeThreshold = 50;

         // Detectar el inicio del toque
        $(document).on('touchstart', function(e) {
          touchStartX = e.changedTouches[0].screenX;
        });

        // Detectar el final del toque y decidir si fue un "swipe"
        $(document).on('touchend', function(e) {
          touchEndX = e.changedTouches[0].screenX;
          handleSwipe();
        });

        // Función para manejar el gesto de deslizamiento
        function handleSwipe() {
          if (touchStartX - touchEndX > swipeThreshold) {
            // Swipe hacia la izquierda - Ocultar Sidebar
            $sidebar.addClass('hidden');
            $mainPanel.addClass('full-width');
          }
          if (touchEndX - touchStartX > swipeThreshold) {
            // Swipe hacia la derecha - Mostrar Sidebar
            $sidebar.removeClass('hidden');
            $mainPanel.removeClass('full-width');
          }
        }*/

        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });
        

        $(".nav-link").click(function(e) {
            e.preventDefault();
            $(this).next(".expanded-options").toggleClass("expanded");
        });

        $(document).ready(function() {
          // Sidebar está oculta al cargar
          $(".sidebar").removeClass("active");
          $(".main-panel").removeClass("active");

          // Evento para mostrar/ocultar la sidebar
          $("#toggleSidebar").click(function() {
            $(".sidebar").toggleClass("active"); // Alterna la visibilidad de la sidebar
            $(".main-panel").toggleClass("active"); // Mueve el contenido principal cuando la sidebar está visible
          });
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>