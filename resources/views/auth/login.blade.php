<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iglesia Bethel Login</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
  </head>
  <body>
    <div class="container mt-4">
      @include('layouts.flash-message')
    </div>

    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-8 mt-5">
          <div class="card">
            <div class="card-header font-weight-bold">{{ __('Inicio de Sesión') }}</div>
    
            <div class="card-body">
              <form method="POST" action="{{ route('authenticate') }}">
                @csrf
   
                <div class="row form-group">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('e-mail') }}</label>
    
                  <div class="col-md-6">
                    <input id="email" type="email" placeholder="Correo electrónico"
                      class="form-control @error('email') is-invalid @enderror" name="email"
                      value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
    
                <div class="row form-group">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
    
                  <div class="col-md-6">
                    <input id="password" type="password" placeholder="Contraseña"
                      class="form-control @error('password') is-invalid @enderror" name="password"
                      required autocomplete="current-password">
    
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
    
                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                      <label class="form-check-label" for="remember">
                        {{ __('Recordad Credenciales') }}
                      </label>
                    </div>
                  </div>
                </div>
    
                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Entrar') }}
                    </button>
    
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Olvido su contraseña?') }}
                      </a>
                    @endif
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </body>
</html>





