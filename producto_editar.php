<?php
include('./php/conexion_be.php');
//===========================================================
//Usuario
//Trae los Usuario
$query ="SELECT * FROM `productos` WHERE `id_productos` = " . $_GET['id_productos'];
$result = mysqli_query($conexion,$query);
$productos = $result->fetch_all(MYSQLI_ASSOC);
$producto = $productos[0];
//===========================================================
//===========================================================
//Fotos
//Trae las Fotos
$query ="SELECT * FROM `fotos` WHERE `id_productos` = '" . $producto['id_productos'] ."'";
$result = mysqli_query($conexion,$query);
$fotos = $result->fetch_all(MYSQLI_ASSOC);

//===========================================================
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
  <body style="min-height: 100vh;background-image: url('./imagenes/subasta.jpg');background-position: center;background-size: cover;background-repeat:no-repeat ;max-width: 100%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                                <li class="nav-item active">
                                <a class="nav-link" href="./equipos.php">Parametrizacion de equipos</a>
                                </li>
                                <li class="nav-item active">
                                <a class="nav-link" href="./php/unlogin.php">Salir</a>
                                </li>
                            </ul>
                            <img class="img-fluid float-end" src="./imagenes/logonegro.jpg" alt="">
                        </div>
                    </div>
                </nav>        
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-6 text-center">
                <h1 class="text-white">Editar Equipos</h1>
            </div>
            <div class="col-6 text-end">
            <a href="equipos.php"class="btn btn-success btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i class="fas fa-reply mr-2"></i> Volver</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-4 formulario pl-2 pr-2 pt-4 pb-4">
            <div class="col-12 col-md-10">
                <form action="./procesos.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id_productos" value="<?php  echo($_GET['id_productos']); ?>">
                    <?php include_once('./producto_form.php'); ?>
                </form>
            </div>
            <hr>
            <div class="col-12">
              <div class="row text-center">
                <div class="col-12 text-center mb-3">
                  <h4>Imagenes</h4>
                </div>
                <div class="col-12 mb-3">
                  <div class="row d-flex justify-content-around">
                    <?php
                    foreach ($fotos as $foto) {
                      echo('<div class="col-3" style="border: 3px solid black;">');
                      echo('<div class="row">');
                      echo('<div class="col-12 text-center">');
                      echo('<img class="img-fluid w-100" src="./imagenes/'.$foto['url'].'" alt="">');
                      echo('</div>');
                      echo('<div class="col-12 text-center mt-2 row_data" id="row_data">');
                      echo('<form action="./procesos.php" class="d-inline form-eliminar-foto" method="POST">');
                      echo('<input type="hidden" name="accion" value="eliminar_foto">');
                      echo('<input type="hidden" name="id_foto" value="'.$foto['id_foto'].'">');
                      echo('<input type="hidden" name="id_productos" value="'.$_GET['id_productos'].'">');
                      echo('<button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">');
                      echo('<i class="fa fa-fw fa-trash fa-2x text-danger"></i>');
                      echo('</button>');
                      echo('</form>');
                      echo('</div>');
                      echo('</div>');
                      echo('</div>'); 
                    }
                    ?>
                    
                  </div>                  
                </div>
                <hr>
                <div class="col-12 mt-3">
                  <div class="row">
                    <form class="d-flex justify-content-center agregar" action="./procesos.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="agregar">
                        <input type="hidden" name="id_productos" value="<?php  echo($_GET['id_productos']); ?>">
                        <div class="col-12 col-md-6 mb-5 mr-3form-group">
                          <label for="archivo">Imagen del Producto</label>
                          <input type="file" class="form-control form-control-sm" name="archivo" id="archivo" accept="image/png,image/jpeg" required/>
                        </div>
                        <div class="col-12 col-md-3 mb-5 ml-3 d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm pl-5 pr-5 w-75">Agregar</button>
                        </div>
                    </form>
                  </div>
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