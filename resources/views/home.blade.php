@extends('adminlte::page')

@section('title', 'Panel de control')

@section('content')
<div class="row">
   <div class="col-md-8">
      <img class="img img-rounded w-100" src="{{ asset('images/banner-certificados.jpg') }}" alt="Banner certificados">
   </div>
   <div class="col-md-4 pt-2">
      <h3>¡Expedición de certificados!</h3>
      <hr>
      <div class="text-center h-100">
         <iframe class="img w-75 h-75" src="https://www.youtube.com/embed/dWkU17R2SyM?si=LpiEhugtTRsA4a_f"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
   </div>
</div>
<hr>

<div class="row justify-content-around p-3">
   <div class="col-md-5 text-justify p-3 border border-info">
      <p style="color: #333333;font-size: 18px;">Apreciado estudiante, para solicitar su certificado por favor dar click
         en el menú lateral: <b>"Solicitar certificado"</b> y llenar el formulario que aparece a continuación.</p>
      <p style="color: #333333;font-size: 18px;">Para resivar el estado de sus solicitudes por favor dar click en el
         menu lateral: <b>"Mis solicitudes"</b> allí encontrará todas las solicitudes realizadas
         y las observaciones de las mismas, así como el certificado en formato pdf.</p>
   </div>
   <div class="col-md-5 text-justify p-3 border border-info">
      <p style="color: #333333;font-size: 18px;">Si solicita varios certificados, debe adjuntar en un único pdf, todos
         pagos pecuniarios realizados en el campo: <b>"Adj. recibo de pago UTS"</b>.</p>
      <p style="color: #333333;font-size: 18px;"><b>Recuerde:</b> El correo electrónico que va ingresar, es con el que
         tendremos contacto con usted y al cual enviaremos notificaciones y el certificado una vez sea generado.</p>
   </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
</script>
@stop
