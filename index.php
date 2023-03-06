<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Register - MagtimusPro</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="icon" type="image/jpg" href="./imagenes/logo.png"/>
</head>
<body>
    <div class="contenedor" style="width: 100vw; height: 100vh;background-color: rgba(0, 156, 255, 0.3);position: fixed;">
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login" style="display: none;">
                                <img class="img-fluid" src="./imagenes/logofull.png" style="max-width: 200px;" alt="">
                                <h3>¿Ya tienes una cuenta?</h3>
                                <p>Inicia sesión para entrar en la página</p>
                                <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <img class="img-fluid" src="./imagenes/logofull.png" style="max-width: 200px;" alt="">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>
                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="php/login_usuario_be.php" method ="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo Electronico" name ="Correo">
                        <input type="password" placeholder="Contraseña" name ="Passw">
                        <button>Entrar</button>
                    </form>

                    <!--Register-->
                    <form action="php/registro_usuario_be.php" method ="POST" class="formulario__register">
                        <h2>Regístrarse</h2>
                        <input type="text" placeholder="Nombre completo" name ="Nombre completo">
                        <input type="text" placeholder="Correo Electronico" name = "Correo">
                        <input type="text" placeholder="Usuario" name = "Usuario">
                        <input type="password" placeholder="Contraseña" name= "Passw">
                        <button>Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="assets/js/script.js"></script>
        </div>
</body>
</html>