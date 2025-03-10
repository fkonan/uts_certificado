<!DOCTYPE html>
<html>
<head>
    <title>Certificado de la solicitud: {{$solicitud_id}}</title>
</head>
<body>
    <p>Hola, {{ $nombre }}</p>
    <p>Se ha generado los certificados de acuerdo a su solicitud.</p>
    <p>Adjunto encontrará su certificado.</p>
    <br>
    <p>Saludos,</p>
    <p>{{ config('adminlte.entidad') }}</p>
</body>
</html>
