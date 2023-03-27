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
include('./php/conexion_be.php');
//===========================================================
//Asignaciones
//Trae las Usuario
$query ="SELECT c.nombre_completo , c.correo ,d.categoria, b.marca,b.procesador,b.modelo_equipo,b.serie, b.costo FROM `compras` AS a
INNER JOIN productos AS b on a.`id_productos` = b.`id_productos`
INNER JOIN usuarios AS c ON a.`id` = c.id
INNER JOIN categorias AS d ON b.id_cat = d.id_cat;";
$result = mysqli_query($conexion,$query);
$subastas = $result->fetch_all(MYSQLI_ASSOC);
//===========================================================
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
    <link rel="stylesheet" href="./assets/librerias/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/librerias/select.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/librerias/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./assets/librerias/buttons.dataTables.min.css">
    <link rel="stylesheet" href="./assets/librerias/fontawesome.min.css"/> 
    <link rel="stylesheet" href="./assets/librerias/sweetalert2.min.css">
    <script src="./assets/librerias/e00ad09966.js" crossorigin="anonymous"></script>
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
                                <a class="nav-link active" aria-current="page" href="./asignacion.php">Asignación de equipos</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="./equipos.php">Parametrizacion de equipos</a>
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
                <div class="row mt-3"
                style="border-radius: 10px;
                        border: 2px solid  black; 
                        margin-left: 7px;
                        margin-right: 7px;
                        -webkit-box-shadow: 6px 6px 2px 0px rgba(0, 0, 0, 0.75);
                        -moz-box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
                        box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
                        margin-left: 20px;
                        margin-right: 20px;
                        margin-bottom: 30px;
                        border-radius: 5px;
                        background-color: rgba(255, 255, 255, 0.25);
                        border-radius: 5px;">
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-10 text-center">
                                <h1>Asignación de equipos</h1>
                            </div>
                            <hr>
                            <div class="col-10 table-responsive">
                                <table class="table table-striped table-hover table-bordered table-sm display">
                                    <thead>
                                        <tr>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Procesador</th>
                                        <th scope="col">Serie</th>
                                        <th scope="col">Aporte</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($subastas as $subasta) {
                                                echo('<tr>');
                                                echo('<td>'.$subasta['nombre_completo'].'</td>');
                                                echo('<td>'.$subasta['correo'].'</td>');
                                                echo('<td>'.$subasta['categoria'].'</td>');
                                                echo('<td>'.$subasta['marca'].'</td>');
                                                echo('<td>'.$subasta['modelo_equipo'].'</td>');
                                                echo('<td>'.$subasta['procesador'].'</td>');
                                                echo('<td>'.$subasta['serie'].'</td>');
                                                echo('<td class="text-end"> $ '.number_format(floatval($subasta['costo']),2,'.',',').'</td>');
                                                echo('</tr>');
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="./assets/librerias/jquery.dataTables.min.js"></script>
    <script src="./assets/librerias/dataTables.bootstrap5.min.js"></script>
    <script src="./assets/librerias/dataTables.select.min.js"></script>
    <script src="./assets/librerias/dataTables.buttons.min.js"></script>
    <script src="./assets/librerias/jszip.min.js"></script>
    <script src="./assets/librerias/pdfmake.min.js"></script>
    <script src="./assets/librerias/vfs_fonts.js"></script>
    <script src="./assets/librerias/buttons.html5.min.js"></script>
    <script src="./assets/librerias/buttons.print.min.js"></script>
    <script src="./assets/librerias/sweetalert2.all.min.js"></script>
    <script src="./assets/js/equipos.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
   
  </body>
</html>