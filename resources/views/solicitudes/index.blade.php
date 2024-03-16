@extends('adminlte::page')

@section('title', 'Mis Solicitudes')

@section('adminlte_css')
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css">
@stop

@section('content_header')
   <h1>Mis solicitudes</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Listado de solicitud de certificados</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-sm">Nueva solicitud</a>
            </div>
         </div>
      </div>
      <div class="card-body ">
         <table id="table" class="table table-sm" data-search="true">
            <thead>
               <tr class="bg-success">
                  <th data-sortable="true" data-field="datos.certificados.tipo_certificado">Certificado solicitado</th>
                  <th data-sortable="true" data-field="estado">Estado de la solicitud</th>
                  <th data-field="mensaje" data-formatter="created_ad">Fecha de la solicitud</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($datos as $item)
                  @foreach ($item->certificados as $certificado)
                     <tr>
                        <td>{{ $certificado->tipo_certificado }}</td>
                        <td>{{ $item->estado }}</td>
                        <td>{{ $item->created_at }}</td>
                     </tr>
                  @endforeach
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
@stop


@section('adminlte_js')
   <script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
@stop
