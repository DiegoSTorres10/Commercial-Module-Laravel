<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/Register.css')}}">
    <link rel="stylesheet" href="{{ asset('css/cdn_Bootrap.min.css') }}" type="text/css">

    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>

    <title>Registrar</title>
</head>

<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                
                <div class="form-group">
                        
                </div>
                    <form autocomplete="off" novalidate method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="mt-4">Registrate</h2>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-contenedor">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                                        <label for="name">Nombre </label>
                                    </div>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="input-contenedor">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <input type="text" name="cargo" id="cargo" value="{{ old('cargo') }}" required>
                                        <label for="cargo">Cargo </label>
                                    </div>

                                    @error('cargo')
                                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    
                                </div>

                                <div class="col-md-6 mx-">
                                    <div class="input-contenedor">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="text" name="email" id="email" value="{{ old('email') }}" required>
                                        <label for="email">Correo </label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="ErrorEmail">
                                    </div>


                                    <div class="input-contenedor">
                                        <i class="fa-solid fa-fw fa-eye field-icon toggle-password"></i>
                                        <input type="password" id="password" name="password" required>
                                        <label for="password_confirmation">Confirmar Contraseña </label>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="color: white; text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    <div class="input-contenedor">
                                        <i class="fa-solid fa-fw fa-eye field-icon toggle-password1"></i>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            required autocomplete="new-password">
                                        <label for="password_confirmation">Confirmar Contraseña </label>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="col-md-12">
                        <strong for="modulos" class="blanco Mo"> Módulos de acceso </strong>
                        <div class="fila">
                                <div  id="ColumnasModulos">
                                    @foreach($modulos as $modulo)
                                    <label class="mx-4">
                                        <input type="checkbox" name="modulos[]" id="modulos" value="{{ $modulo->IdModulo}}" class="blanco" > <span class="blanco">{{ $modulo->NombreModulo }}</span>
                                    </label>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                    <div class="centrar">
                        <button class="button1 mt-4" type="submit">Registrarse</button>
                    </div>
                </form>

                <div class="registrar">
                    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Haga click aqui</a></p>
                </div>

            </div>

        </div>
    </section>

    <script>     
        document.addEventListener('DOMContentLoaded', function () {
            function adjustLayout() {
                var columnasModulos = document.getElementById('ColumnasModulos');
                if (window.innerWidth >= 300 && window.innerWidth <= 1200) {
                    columnasModulos.classList.add('row');
                } else {
                    columnasModulos.classList.remove('row');
                }
            }

            adjustLayout(); 
            window.addEventListener('resize', adjustLayout);


            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('#password');

            const togglePassword1 = document.querySelector('.toggle-password1');
            const passwordInput1 = document.querySelector('#password_confirmation');

            togglePassword.addEventListener('click', function () {
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });



            togglePassword1.addEventListener('click', function () {
                togglePassword1.classList.toggle('fa-eye');
                togglePassword1.classList.toggle('fa-eye-slash');

                if (passwordInput1.type === 'password') {
                    passwordInput1.type = 'text';
                } else {
                    passwordInput1.type = 'password';
                }
            });
        });

            



    </script>
</body>

</html>