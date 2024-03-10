<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Registro - Uts Certificados</title>

   <!-- Font Icon -->
   <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

   <!-- Main css -->
   <link rel="stylesheet" href="{{ asset('css/style.css')}}">

   @if (config('adminlte.google_fonts.allowed', true))
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   @endif

</head>

<body>
    @yield('body')

    @yield('auth_js')
</body>

</html>
