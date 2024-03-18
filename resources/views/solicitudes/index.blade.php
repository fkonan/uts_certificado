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
         <table id="table" class="table table-sm table-hover" data-search="true">
            <thead>
               <tr class="bg-success">
                  <th data-sortable="true" data-field="datos.certificados.tipo_certificado">Certificado solicitado</th>
                  <th data-sortable="true" data-field="estado">Estado de la solicitud</th>
                  <th data-field="created_at">Fecha de la solicitud</th>
                  <th data-field="observaciones">Observaciones</th>
                  <th data-field="ruta">Certificado</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($datos as $item)
                  @foreach ($item->certificados as $certificado)
                     <tr>
                        <td>{{ $certificado->tipo_certificado }}</td>
                        <td>{{ $certificado->pivot->estado }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $certificado->pivot->observaciones }}</td>
                        <td>
                           @if ($certificado->pivot->ruta)
                              <a href="{{ asset(Storage::url($certificado->pivot->ruta)) }}" target="_blank"><i
                                    class="fas fa-file-pdf fa-lg text-danger"></i> Descargar</a>
                           @else
                              <i class="fas fa-file fa-lg text-muted"></i>
                           @endif
                        </td>
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
