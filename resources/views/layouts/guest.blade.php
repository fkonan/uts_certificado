<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

   {{-- Base Meta Tags --}}
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   {{-- Custom Meta Tags --}}
   @yield('meta_tags')

   {{-- Title --}}
   <title>
      @yield('title_prefix', config('adminlte.title_prefix', ''))
      @yield('title', config('adminlte.title', 'Titulo por defecto'))
      @yield('title_postfix', config('adminlte.title_postfix', ''))
   </title>

   {{-- Custom stylesheets (pre AdminLTE) --}}
   @yield('adminlte_css_pre')
   {{-- Base Stylesheets --}}
   @if (!config('adminlte.enabled_laravel_mix'))
   <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

   @if (config('adminlte.google_fonts.allowed', true))
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   @endif
   @else
   <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
   @endif

   {{-- Extra Configured Plugins Stylesheets --}}
   @include('adminlte::plugins', ['type' => 'css'])

   {{-- Livewire Styles --}}
   @if (config('adminlte.livewire'))
   @if (intval(app()->version()) >= 7)
   @livewireStyles
   @else
   <livewire:styles />
   @endif
   @endif

   {{-- Custom Stylesheets (post AdminLTE) --}}
   @yield('adminlte_css')

   {{-- Favicon --}}
   @if (config('adminlte.use_ico_only'))
   <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
   @elseif(config('adminlte.use_full_favicon'))
   <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
   <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
   <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
   <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
   <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
   <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
   <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
   <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
   <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
   <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
   <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
   <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
   @endif

</head>

<body class="container-fluid" @yield('body_data') style="height: auto;">
   <div class="row my-3">
      <div class="col-12 text-center">
         <img src="{{asset('images/banner-certificados.jpg')}}" class="img-responsive" alt="">

         <div class="row">
            <div class="col-md-12">
               <div class="container mt-3">

                  @yield('body')
               </div>
            </div>

         </div>
      </div>
      {{-- <div class="col-md-4">
         <div class="container mt-3">
            <img src="{{asset('images/banner-certificados-vertical.jpg')}}" alt="">
         </div>
      </div> --}}
   </div>
   <footer class="container-fluid bg-secondary">
      <div class="container">
         <div class="row py-5">
            <div class="col-md-3">
               <div class="footer-widget-col">
                  <h5 class="widget-title font-weight-bold">ORIÉNTESE</h5>
                  <ul class="list-unstyled" style="font-size:18px;">
                     <li><a href="https://www.uts.edu.co/sitio/atencion-al-ciudadano/" class="text-light">Atención al
                           Ciudadano</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/resoluciones/res-355.pdf?_t=1700745415">Valores
                           Pecuniarios</a></li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/normatividad/">Normatividad</a>
                     </li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/base-documental-uts/" target="_blank"
                           rel="noopener noreferrer">Base Documental</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/administrativos/directorio_uts.pdf"
                           target="_blank" rel="noopener noreferrer">Directorio de Contactos</a></li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/mapa-del-sitio/">Mapa del
                           Sitio</a>
                     </li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/atencion-al-ciudadano/preguntas-frecuentes">Preguntas
                           Frecuentes</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/terminos-y-condiciones-de-uso-del-portal-web/"
                           target="_blank" rel="noopener noreferrer">Términos y condiciones</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/acuerdos/acu-65.pdf?_t=1621357271"
                           target="_blank" rel="noopener noreferrer">Política de privacidad</a></li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/aviso-de-privacidad/" target="_blank"
                           rel="noopener noreferrer">Aviso de privacidad</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3">
               <div class="footer-widget-col">
                  <h5 class="widget-title font-weight-bold">INFORMACIÓN PÚBLICA</h5>
                  <ul class="list-unstyled" style="font-size:18px;">
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/transparencia-y-acceso-a-la-informacion-publica-2/">Transparencia</a>
                     </li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/contratacion/">Contratación</a></li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/tramites-y-servicios/">Trámites y
                           Servicios</a></li>
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/entes-de-control/">Entes de
                           Control</a></li>
                     <li><a class="text-light" href="https://ninos.uts.edu.co/" target="_blank"
                           rel="noopener noreferrer">Portal de
                           Niños</a>
                     </li>
                     <li><a class="text-light" href="https://gdeco.uts.edu.co/proveedores" target="_blank"
                           rel="noopener noreferrer">Inscripción y actualización de proveedores en línea</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3">
               <div class="footer-widget-col">
                  <h5 class="widget-title font-weight-bold">LINEAMIENTOS</h5>
                  <ul class="list-unstyled" style="font-size:18px;">
                     <li><a class="text-light" href="https://www.uts.edu.co/sitio/calendario-academico" target="_blank"
                           rel="noopener noreferrer">Calendario Académico</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/2019/10/REGLAMENTO_ESTUDIANTIL_ENERO_2022.pdf"
                           target="_blank" rel="noopener noreferrer">Reglamento Estudiantil</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/regla_disc_est.pdf"
                           target="_blank" rel="noopener noreferrer">Reglamento Disciplinario Estudiantil</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/estatuto_docente.pdf"
                           target="_blank" rel="noopener noreferrer">Estatuto Docente</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/reglamento_disciplinario_docente.pdf"
                           target="_blank" rel="noopener noreferrer">Reglamento Disciplinario Docente</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/estatuto_general.pdf"
                           target="_blank" rel="noopener noreferrer">Estatuto General</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/acuerdos/acu-73.pdf?_t=1629462746"
                           target="_blank" rel="noopener noreferrer">Reglamento Trabajo de Grado</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/acuerdos/acu-37.pdf?_t=1582322783"
                           target="_blank" rel="noopener noreferrer">Modelo de Bienestar Institucional</a></li>
                     <li><a class="text-light"
                           href="https://www.uts.edu.co/sitio/wp-content/uploads/normatividad/resoluciones/res-224.PDF?_t=1641917172"
                           target="_blank" rel="noopener noreferrer">Manual de Contratación</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3">
               <div class="footer-widget-col">
                  <div class="textwidget custom-html-widget text-center">
                     <img src="https://www.uts.edu.co/sitio/sello-icontec_iso-9001_bn/" width="80" alt="ISO 9001">
                     <p>SC-CER469205</p>
                     <a href="https://www.colombia.co/"><img
                           src="https://www.uts.edu.co/sitio/wp-content/uploads/2019/10/logo-co.png"
                           alt="Colombia.co"></a>
                     <br><br>
                     <a href="https://www.gov.co/home/"><img
                           src="https://www.uts.edu.co/sitio/wp-content/uploads/2019/10/header_govco.png" width="100"
                           alt="Gov.co"></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>

   {{-- Base Scripts --}}
   @if (!config('adminlte.enabled_laravel_mix'))
   <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
   @else
   <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
   @endif


   {{-- Livewire Script --}}
   @if (config('adminlte.livewire'))
   @if (intval(app()->version()) >= 7)
   @livewireScripts
   @else
   <livewire:scripts />
   @endif
   @endif

   {{-- Custom Scripts --}}
   @yield('adminlte_js')
   <script>
      var forms = document.querySelectorAll('.needs-validation')
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
         .forEach(function(form) {
            form.addEventListener('submit', function(event) {
               if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
               }
               form.classList.add('was-validated')
            }, false)
         })
   </script>
</body>

</html>