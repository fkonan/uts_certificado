@extends('adminlte::page')

@section('title', 'Solicitud')

@section('adminlte_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css">
@stop

@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Datos de la solicitud</h5>
         </div>
         <div class="col text-right">
            <a href="{{ route('solicitudes.index') }}" class="btn btn-primary">Volver</a>
         </div>
      </div>
   </div>
   <div class="card-body ">
      <table id="table" class="table table-sm table-hover" data-search="true">
         <thead>
            <tr class="bg-success">
               <th data-sortable="true" data-field="datos.certificados.tipo_certificado">Nombre del certificado
               </th>
               <th data-field="tipo_documento">Tipo de documento</th>
               <th data-field="documento">Documento del estudiante/egresado</th>
               <th data-field="nombre_completo">Nombre del estudiante/egresado</th>
               <th data-field="observaciones">Observaciones</th>
               <th data-field="estado">Estado</th>
               <th data-field="created_at">Fecha la solicitud</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($datos as $item)
            @foreach ($item->certificados as $certificado)
            <tr>
               <td>{{ $certificado->tipo_certificado }}</td>
               <td>{{ $item->tipo_documento }}</td>
               <td>{{ $item->documento }}</td>
               <td>{{ $item->nombre_completo }}</td>
               <td>{{ $item->oservaciones }}</td>
               <td>{{ $item->estado }}</td>
               <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
            @endforeach
         </tbody>
      </table>
   </div>
   <div class="card-footer">
      <form action="{{ route('solicitudes.updateArchivos') }}" method="post" enctype="multipart/form-data" novalidate>
         @csrf
         <div class="row justify-around">
            <input type="hidden" name="id" value="{{ $datos[0]->id }}">

            @if($datos[0]->edit_adj_documento)
            <div class="col-3">
               <x-adminlte-input-file name="adj_documento" igroup-size="sm" placeholder="Seleccionar archivo..."
                  label="Adj. documento de identidad" label-class="text-lightblue" legend="Cargar" required
                  accept=".pdf">
                  <x-slot name="prependSlot">
                     <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                     </div>
                  </x-slot>
               </x-adminlte-input-file>
            </div>
            @endif

            @if($datos[0]->edit_adj_estampilla)
            <div class="col-3">
               <x-adminlte-input-file name="adj_estampilla" igroup-size="sm" placeholder="Seleccionar archivo..."
                  label="Adj. estampilla" label-class="text-lightblue" legend="Cargar" required accept=".pdf">
                  <x-slot name="prependSlot">
                     <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                     </div>
                  </x-slot>
               </x-adminlte-input-file>
            </div>
            @endif

            @if($datos[0]->edit_adj_pago)
            <div class="col-3">
               <x-adminlte-input-file name="adj_pago" igroup-size="sm" placeholder="Seleccionar archivo..."
                  label="Adj. recibo de pago UTS" label-class="text-lightblue" legend="Cargar" required accept=".pdf">
                  <x-slot name="prependSlot">
                     <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                     </div>
                  </x-slot>
               </x-adminlte-input-file>
            </div>
            @endif

            @if($datos[0]->edit_adj_pago || $datos[0]->edit_adj_estampilla || $datos[0]->edit_adj_documento)
            <div class="col-3 mt-3">
                  <button class="btn btn-success mt-3" type="submit">Actualizar archivos</button>
               </div>
               <div class="col-12">
                  <p class="text-info"><b>Nota:</b> Debe actualizar los documentos para continuar con el proceso de solicitud, los archivos deben ir en formato pdf.
               </div>
            @endif
         </div>
      </form>
   </div>
</div>
@stop

@section('adminlte_js')
<script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
@stop
