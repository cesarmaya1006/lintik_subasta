<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    if ($mensaje == 'El correo envio de manera correcta') {
        $alert =
            "
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '" .
            $mensaje .
            "',
        showConfirmButton: false,
        timer: 1500
      })
    ";
    } else {
        $alert =
            "
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: '" .
            $mensaje .
            "',
        showConfirmButton: false,
        timer: 1500
      })
    ";
    }
    $_SESSION['mensaje'] = $mensaje;
}elseif(isset($_SESSION['mensaje_camb']))
{
    $mensaje_camb = $_SESSION['mensaje_camb'];
    $alertmensaje_camb =
            "
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '" .
            $mensaje_camb .
            "',
        showConfirmButton: false,
        timer: 1500
      })
    ";
}
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="./imagenes/logo.png"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="./assets/librerias/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Login y Register - Lintic</title>
  </head>
  <body>
    <div class="row d-flex justify-content-center align-content-center" style="min-height: 98vh;background-color: rgba(0, 156, 255, 0.3);">
        <div class="col-11 col-md-6 pt-2 pb-2 pr-2 mt-5 mb-5" style="background-color: rgba(0, 217, 255, 0.5); border-radius: 5px;margin-left: 8px;">
            <div class="row" style="padding-right: 8px;padding-left: 8px;">
                <div class="col-12 col-md-6 caja_trasera text-white mt-5 mb-5 d-flex justify-content-center">
                    <div class="t_login d-none">
                        <img class="img-fluid" src="./imagenes/logofull.png" style="max-width: 200px;" alt="">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button class="btn btn_caja" id="btn_iniciar">Iniciar Sesión</button>
                    </div>
                    <div class="t_register">
                        <img class="img-fluid" src="./imagenes/logofull.png" style="max-width: 200px;" alt="">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button class="btn btn_caja" id="btn_registrarse">Regístrarse</button>
                    </div>
                </div>
                <div class="col-12 col-md-6 mr-2 caja_delantera" style="background-color: white; border-radius: 10px;">
                    <form action="php/login_usuario_be.php" method ="POST" class="formulario_login d-flex flex-column">
                        <div class="row">
                            <div class="col-12 mt-5 mb-4"><h2>Iniciar Sesión</h2></div>
                            <div class="col-12 mt-3 mb-4 form-group">
                                <input type="text" class="form-control form-control-sm" name="Correo" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-12 mb-4 form-group">
                                <input type="password" class="form-control form-control-sm" name="Passw" placeholder="Contraseña" required>
                            </div>
                            <div class="col-12 mt-3 mb-4"><button class="btn btn-primary btn-xs pl-5 pr-5">   Entrar   </button></div>
                            <div class="col-12 mb-4"><a href="recuperar.php">Ovidé mi contraseña</a></div>
                        </div>
                    </form>
                    <!--Register-->
                    <form action="php/registro_usuario_be.php" method ="POST" class="formulario_register d-none">
                        <div class="row">
                            <div class="col-12 mt-5 mb-4"><h2>Registrarse</h2></div>
                            <div class="col-12 mt-3 mb-4 form-group">
                                <input type="text" class="form-control form-control-sm" name="Nombre completo" id="Nombre completo" placeholder="Nombre completo" required>
                            </div>
                            <div class="col-12 mt-3 mb-4 form-group">
                                <input type="text" class="form-control form-control-sm" name="Correo" id="Correo" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-12 mt-3 mb-4 form-group">
                                <input type="text" class="form-control form-control-sm" name="Usuario" id="Usuario" placeholder="Usuario" required readonly>
                            </div>
                            <div class="col-12 mb-4 form-group">
                                <input type="password" class="form-control form-control-sm" name="Passw" id="Passw" placeholder="Contraseña" required>
                            </div>
                            <div class="col-12 mt-3 mb-4"><button class="btn btn-primary btn-xs pl-5 pr-5">   Regístrarse   </button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="redes position-fixed bottom-0 end-0 d-flex flex-md-column-reverse">
            <a href="https://www.facebook.com/linktic" target="_blank" class="mb-3"><img src="assets/images/facebook.png" style="height: 50px; width: 50px;"></a>
            <a href="https://www.instagram.com/linktic/?hl=en" target="_blank" class="mb-3"><img src="assets/images/instagram.png" style="height: 50px; width: 50px;"></a>
            <a href="https://mobile.twitter.com/grupolinktic" target="_blank" class="mb-3"><img src="assets/images/twiter.png" style="height: 50px; width: 50px;"></a>
            <a href="https://wa.me/573145753310?" target="_blank" class="mb-3"><img src="assets/images/whatsapp.png" style="height: 50px; width: 50px;"></a>
        </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/librerias/jquery-3.5.1.js"></script>
    <script src="./assets/js/index.js"></script>
    <script>
        <?php 
        if (isset($_SESSION['mensaje'])) {echo $alert;}
        if (isset($_SESSION['mensaje_camb'])) {echo $alertmensaje_camb;}
        session_destroy();
        ?>
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>