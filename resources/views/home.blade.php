@extends('adminlte::page')

@section('title', 'Panel de control')

@section('content')
<div class="row">
   <div class="col-md-8">
      <img class="img img-rounded w-100" src="{{asset('storage')}}/{{$datos->banner}}" alt="Banner certificados">
   </div>
   <div class="col-md-4 pt-2">
      <h3>{{$datos->titulo_video}}</h3>
      <hr>
      <div class="text-center h-100">
         <iframe class="img w-75 h-75" src="{{$datos->url_video}}"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
   </div>
</div>
<hr>

<div class="row justify-content-around p-3">
   <div class="col-md-5 text-justify p-3 border border-info">
      <p style="color: #333333;font-size: 18px;">
         {!!$datos->texto1!!}
      </p>
   </div>
   <div class="col-md-5 text-justify p-3 border border-info">
      <p style="color: #333333;font-size: 18px;">
         {!!$datos->texto2!!}
      </p>
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
