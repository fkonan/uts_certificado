@extends('adminlte::auth.layout.master')

@section('body')
   <div class="main">
      <section class="sign-in">
         <div class="container">
            <div class="signin-content">
               <div class="signin-image">
                  <figure><img src="{{ asset('images/signin-image.jpg') }}" alt="sing up image"></figure>
               </div>

               <div class="signin-form" style="margin-left:0px;padding-top:20px;">
                  <h2 class="form-title">Verificar Cuenta</h2>
                  <p style="margin-bottom:15px;">Necesitas verificar tu correo para habilitar tu cuenta. Si no te ha
                     llegado algún mensaje, por favor dar click en el siguiente botón.</p>
                  <form class="register-form" method="POST" action="{{ route('verification.resend') }}"
                     style="text-align:center;">
                     @csrf
                     <button type="submit" class="form-submit">Reenviar correo de validación</button>.
                  </form>
                  @if ($message = Session::get('success'))
                     <h4 style="color:#0455a6;">
                        Hemos validado tu cuenta correctamente, puedes continuar.
                     </h4>
                  @endif
                  @if (session('resent'))
                     <h4 style="color:#0455a6;">
                        Hemos enviado nuevamente la verificación de tu cuenta al correo registrado.
                     </h4>
                  @endif
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
