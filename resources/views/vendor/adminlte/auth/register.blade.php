@extends('adminlte::auth.layout.master')

@section('body')

   @php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
   @php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

   @if (config('adminlte.use_route_url', false))
      @php($login_url = $login_url ? route($login_url) : '')
      @php($register_url = $register_url ? route($register_url) : '')
   @else
      @php($login_url = $login_url ? url($login_url) : '')
      @php($register_url = $register_url ? url($register_url) : '')
   @endif

   <div class="main">
      <!-- Sing in  Form -->
      <section class="signup">
         <div class="container">
            <div class="signup-content">
               <div class="signup-form">
                  <h2 class="form-title">Registro</h2>
                  <form method="POST" action="{{ $register_url }}" class="register-form" id="register-form">
                     @csrf
                     <div class="form-group" style="margin-bottom: 15px;">
                        <p class="form-label" for="tipo_documento">Tipo de documento</p>
                        <select name="tipo_documento" id="tipo_documento"
                           class="form-select @error('tipo_documento') is-invalid @enderror">

                           <option value="">Seleccionar</option>
                           @foreach (app('tipo_documento') as $key => $value)
                              <option value="{{ $key }}" {{ old('tipo_documento') == $key ? 'selected' : '' }}>
                                 {{ $value }}</option>
                           @endforeach
                        </select>
                        @error('tipo_documento')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="documento"><i class="zmdi zmdi-accounts-list material-icons-name"></i></label>
                        <input type="text" name="documento" id="documento" placeholder="Número de documento"
                           class="form-control @error('documento') is-invalid @enderror" value="{{ old('documento') }}" />
                        @error('documento')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Nombre completo"
                           class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                        @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Correo electrónico"
                           value="{{ old('email') }}" />
                        @error('email')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="telefono"><i class="zmdi zmdi-phone"></i></label>
                        <input type="telefono" name="telefono" id="telefono" placeholder="Teléfono"
                           value="{{ old('telefono') }}" />
                        @error('telefono')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" />
                        @error('password')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                           placeholder="Repetir contraeña" />
                        @error('password_confirmation')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Registrarse" />
                     </div>
                  </form>
               </div>
               <div class="signup-image">
                  <figure><img src="{{asset('images/signup-image.jpg')}}" alt="Ya tengo cuenta"></figure>
                  <a href="/login" class="signup-image-link">Ya tengo una cuenta</a>
               </div>
            </div>
         </div>
      </section>
   </div>
@section('auth_js')
   <!-- JS -->
   <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('js/main.js') }}"></script>
@stop
@stop

</html>
