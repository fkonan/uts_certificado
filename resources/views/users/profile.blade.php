@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<h1>Datos del Estudiante</h1>
@stop

@section('content')
<div class="card">
   <div class="card-body">
      <form action="{{ route('user.profile.update') }}" method="POST">
         @csrf
         @method('PUT')
         <input type="hidden" name="id" value="{{$user->id}}">
         <div class="row">
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="tipo_documento">Tipo de documento</p>
                  <select name="tipo_documento" id="tipo_documento" required
                     class="form-control @error('tipo_documento') is-invalid @enderror">
                     <option value="">Seleccionar</option>
                     @foreach (app('tipo_documento') as $key => $value)
                     <option value="{{ $key }}" {{ (old('tipo_documento') ?? $user->tipo_documento) == $key ? 'selected'
                        :
                        '' }}>
                        {{ $value }}
                     </option>
                     @endforeach
                  </select>
                  @error('tipo_documento')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="documento">Documento</p>
                  <input type="text" name="documento" id="documento" placeholder="Número de documento"
                     class="form-control @error('documento') is-invalid @enderror"
                     value="{{ old('documento') ?? $user->documento }}" required/>
                  @error('documento')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <p class="form-label mb-0" for="name">Nombre completo</p>
                  <input type="text" name="name" id="name" placeholder="Nombre completo"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') ?? $user->name }}" required/>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="telefono">Teléfono</p>
                  <input type="text" name="telefono" id="telefono" placeholder="Teléfono"
                     class="form-control @error('telefono') is-invalid @enderror"
                     value="{{ old('telefono') ?? $user->telefono }}" required/>
                  @error('telefono')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="email">Correo eletrónico</p>
                  <input class="form-control" type="email" name="email" id="email" placeholder="Correo electrónico"
                     value="{{ old('email') ?? $user->email }}" required/>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="password">Contraseña</p>
                  <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" />
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <p class="form-label mb-0" for="password_confirmation">Confirmar contraseña</p>
                  <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                     placeholder="Repetir contraeña" />

                     @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
         </div>

      </form>
   </div>
</div>
@stop
@section('js')
<script>


</script>
@stop
