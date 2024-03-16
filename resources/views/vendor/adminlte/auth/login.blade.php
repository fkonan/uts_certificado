@extends('adminlte::auth.layout.master')

@section('body')

   @php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
   @php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
   @php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

   @if (config('adminlte.use_route_url', false))
      @php($login_url = $login_url ? route($login_url) : '')
      @php($register_url = $register_url ? route($register_url) : '')
      @php($password_reset_url = $password_reset_url ? route($password_reset_url) : '')
   @else
      @php($login_url = $login_url ? url($login_url) : '')
      @php($register_url = $register_url ? url($register_url) : '')
      @php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
   @endif

   <div class="main">
      <!-- Sing in  Form -->
      <section class="sign-in">
         <div class="container">
            <div class="signin-content">
               <div class="signin-image">
                  <figure><img src="{{ asset('images/signin-image.jpg') }}" alt="sing up image"></figure>
                  <a href="/register" class="signup-image-link">¿No tienes cuenta? Registrate</a>
               </div>

               <div class="signin-form">
                  <h2 class="form-title">Iniciar Sesión</h2>
                  <form method="POST" action="{{ $login_url }}" class="register-form" id="login-form">
                     @csrf
                     <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                        <input type="text" name="email"class="@error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="Correo eletrónico" autofocus>
                        @error('email')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>

                     <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock material-icons-name"></i></label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" />
                        @error('password')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember" class="label-agree-term">Recordar sesión</label>
                     </div>
                     <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Iniciar sesión" />
                     </div>
                  </form>
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
