<!doctype html>
<html lang="en">

<head>
  <title>SuRi</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <link rel="icon" type="image/png" href="{{ asset('mainlayout/img/logo.png') }}">

  <!-- Material Kit CSS -->
  <link rel="stylesheet" href="{{asset('MainLayout/css/material-dashboard.css')}}">
</head>

<body class="dark-edition">
  <div class="wrapper ">

    <header class="header">
      <div class="container-fluid">
        <nav class="float-right">
          <ul>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.corral') }}">Corrales</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.lote') }}">Lotes</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.animal') }}">Animales</a>
            </li>
            <li class="nav-item">
              <a  class="btn btn-primary" href="{{ route('menu.alimento') }}">Alimentos</a>
            </li>
            <li class="nav-item">
              <a  class="btn btn-primary" href="{{ route('menu.consumo') }}">Consumos</a>
            </li>
            <li class="nav-item">
              <a  class="btn btn-primary" href="{{ route('menu.venta') }}">Ventas</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button type="submit" class="btn btn-dark btn-block">Log Out</button>
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('MainLayout/img/sidebar-2.jpg')}}">
        <div class="logo">
          <a href="{{asset('principal')}}" class="simple-text logo-normal">
            Administrador 
          </a>
        </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="#" id="expandLink">
              <i class="material-icons">home</i>
              <p>Corrales</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('corral.create') }}">Crear registro</a></li>
              <li><a href="{{ route('corral.index') }}">Mostrar datos</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.lote') }}" id="expandLink">
              <i class="material-icons">layers</i>
              <p>Lotes</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('lote.create') }}">Crear registro</a></li>
              <li><a href="{{ route('lote.index') }}">Mostrar datos</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.animal') }}" id="expandLink">
              <i class="material-icons">pets</i>
              <p>Animales</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('animal.create') }}">Crear registro</a></li>
              <li><a href="{{ route('animales.import.form') }}">Importar datos</a></li>
              <li><a href="{{ route('animal.index') }}">Mostrar datos</a></li>
              <li><a href="{{ route('traspaso.create') }}">Realizar traspaso</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.alimento') }}" id="expandLink">
              <i class="material-icons">grass</i>
              <p>Alimento</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('alimento.create') }}">Crear registro</a></li>
              <li><a href="{{ route('alimentos.import.form') }}">Importar datos</a></li>
              <li><a href="{{ route('alimento.index') }}">Mostrar datos</a></li>
              <li><a href="{{ route('alimento.ShowAgregar') }}">Agregar a inventario</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.consumo') }}" id="expandLink">
              <i class="material-icons">restaurant</i>
              <p>Consumo de alimentos</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('consumo.create')}}">Capturar consumo</a></li>
              <li><a href="{{route('consumo.index')}}">Mostrar datos</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('menu.venta') }}" id="expandLink">
              <i class="material-icons">shopping_cart</i>
              <p>Venta de animal</p>
            </a>
            <ul class="expanded-options" id="expandedOptions">
              <li><a href="{{ route('venta.create')}}">Capturar venta</a></li>
              <li><a href="{{route('venta.index')}}">Mostrar datos</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">     
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          @yield('content')

          <!--/cointainer-fluid-->
        </div>
      </div>
    <footer class="footer">
      <div class="container-fluid">
        <nav class="float-right">
          <ul>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.corral') }}">Corrales</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.lote') }}">Lotes</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.animal') }}">Animales</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.alimento') }}">Alimentos</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.consumo') }}">Consumos</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('menu.venta') }}">Ventas</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button type="submit" class="btn btn-dark btn-block">Log Out</button>
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </footer>
    
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('js/core/jquery.min.js')}}"></script>
  <script src="{{asset('js/core/popper.min.js')}}"></script>
  <script src="{{asset('js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  
  <script src="https://unpkg.com/default-passive-events"></script>
  
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="{{asset('js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard.js?v=2.1.0')}}"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('demo/demo.js')}}"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $("#expandLink").click(function(e) {
        e.preventDefault();
        $("#expandedOptions").toggleClass("expanded");
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
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