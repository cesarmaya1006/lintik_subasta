<?php
session_start();
if ($_SESSION['pefil']!='admin') {
    echo'
    <script>
    alert("usuario sin acceso ");
    window.location = "index.php";
    </script>
    ';
    exit;
}

$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$_SESSION['url'] = $url;
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="./imagenes/logo.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/librerias/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/librerias/fontawesome.min.css"/> 
    <link rel="stylesheet" href="./assets/librerias/sweetalert2.min.css">
    <script src="./assets/librerias/e00ad09966.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/equipos.css">
    <title>Linktic</title>
  </head>
  
  <body style="min-height: 100vh;">
    <div class="container-fluid"  style="width: 100vw; height: 100vh;background-color: rgba(255, 255, 255, 1);">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: rgba(0, 0, 0, 0.75);">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="./asignacion.php">Inicio</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="./asignacion.php">Asignación de equipos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="./equipos.php">Parametrizacion de equipos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./php/unlogin.php">Salir</a>
                                </li>
                            </ul>
                            <img class="img-fluid float-end" src="./imagenes/logonegro.png" alt="" style="max-height: 150px;">
                        </div>
                    </div>
                </nav>        
            </div>
        </div>
        <div class="row d-flex justify-content-center" 
                    style="background-image: url('./imagenes/logofull.png');
                           background-attachment: fixed;
                           background-position: center;
                           background-repeat: no-repeat;
                           background-size: cover;
                           background-size: 600px;">
            <div class="col-12" style="background-color: rgba(255,255,255,0.5); min-height:75vh">
                <div class="row mt-3 mb-5">
                    <div class="col-6 text-center">
                        <h1 class="text-black">Insertar Equipos</h1>
                    </div>
                    <div class="col-6 text-end">
                    <a href="equipos.php"class="btn btn-success btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i class="fas fa-reply mr-2"></i> Volver</a>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-4 formulario pl-2 pr-2 pt-4 pb-4">
                    <div class="col-12 col-md-10">
                        <form action="procesos.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="insertar">
                            <?php include_once('./producto_form.php'); ?>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="./assets/librerias/bootstrap.bundle.min.js"></script>
    <script src="./assets/librerias/jquery-3.5.1.js"></script>
    <script src="./assets/librerias/sweetalert2.all.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>