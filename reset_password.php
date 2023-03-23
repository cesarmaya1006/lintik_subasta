<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="icon" type="image/jpg" href="./imagenes/logo.png"/>
  </head>
  <body>
    <div class="row d-flex justify-content-center" style="background-color: rgba(0, 156, 255, 0.3);min-height: 99vh;">
        <div class="col-5 pl-5 pr-5" style="background-color: rgba(0, 217, 255, 0.5);border-radius: 10px;">
            <div class="row">
                <div class="col-12 text-center pt-5 pb-5">
                    <img class="img-fluid" src="./imagenes/logofull.png" style="max-width: 200px;" alt="">
                </div>
                <div class="col-12 pt-5 pb-5 d-flex justify-content-center flex-column ml-5 mr-5" style="background-color: white; border-radius: 5px;">
                    <div class="row">
                        <div class="col-12">
                            <p>Enviaremos un correo electrónico a su email con el ink de recuperación de contraseña</p>
                        </div>
                    </div>
                    <form class="row" action="procesos.php" method="POST" id="reset_password">
                        <input type="hidden" name="accion" value="new_password">
                        <input type="hidden" name="email" value="<?php  echo($_GET['email']) ?>">
                        <input type="hidden" name="token" value="<?php  echo($_GET['token']) ?>">
                        <div class="col-12 form-group">
                            <label for="password" class="requerido text-black"><strong style="font-size: 1.3em;">Nueva Contraseña</strong></label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password" required>
                        </div>
                        <div class="col-12 form-group">
                            <label for="re_password" class="requerido text-black"><strong style="font-size: 1.3em;">Validar Contraseña</strong></label>
                            <input type="password" class="form-control form-control-sm" name="re_password" id="re_password" required>
                            <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn btn-primary btn-xs mt-3 pl-5 pr-5">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#re_password").on('keyup', function(){
                var password = $("#password").val();
                var confirmPassword = $("#re_password").val();
                if (password != confirmPassword)
                    $("#CheckPasswordMatch").html("Las contraseñas no so iguales !").css("color","red");
                else
                    $("#CheckPasswordMatch").html("Contraseñas Iguales !").css("color","green");
            });
            $("#reset_password").submit(function (e) {
                var password = $("#password").val();
                var confirmPassword = $("#re_password").val();
                if (password != confirmPassword){
                    e.preventDefault();
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Las contraseñas no coiciden!',
                    footer: 'Corrijala e intentelo nuevamente'
                    })

                }
                
                const form = $(this);
            });
        });
     
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>