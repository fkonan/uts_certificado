<!DOCTYPE html>
<html>

<head>
   <title>{{ $asunto }}</title>
</head>

<body>
   <p>{!! $descripcion !!}</p>
   @if ($observaciones!=null)
   <p>Observaciones: </p>
   <p>{{$observaciones}}</p>
   @endif
   <br />
   <p>Saludos,</p>
   <p>{{ config('adminlte.entidad') }}</p>
</body>

</html>
