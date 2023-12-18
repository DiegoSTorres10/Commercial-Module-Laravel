<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/Login.css')}}">
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
    
    <title>Login</title>
</head>

<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                <form autocomplete="off" novalidate method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Iniciar Sesión</h2>


                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" required>
                        <label for="email">Correo </label>
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            <span class="empty-space" style="height: 1.5rem;"></span>
                        </span>
                    @enderror
                    

                    <div class="input-contenedor">
                        <i class="fa-solid fa-fw fa-eye field-icon toggle-password" toggle="#password-field"></i>
                        <input type="password" id="password" name="password" required>
                        <label for="password">Contraseña </label>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                        <span class="empty-space" style="height: 1.5rem;"></span>
                    @enderror
                    
                    <button type="submit">Acceder </button>
                </form>

                <div class="olvidar">
                    <label for="#">
                        <a href="#">¿Has olvidado tu contraseña?</a>
                    </label>
                </div>

                <div class="registrar">
                    <p>No tienes una cuenta <a href="{{ route('register') }}">Haga click aqui</a></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>
</body>

</html>