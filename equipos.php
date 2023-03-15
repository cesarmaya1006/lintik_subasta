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
include('./php/conexion_be.php');
//===========================================================
//Equipos
//Trae las Equipos
$query ="SELECT * FROM `productos` ORDER BY `productos`.`id_cat` ASC";
$result = mysqli_query($conexion,$query);
$equipos = $result->fetch_all(MYSQLI_ASSOC);
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
                        <div class="row mt-3 mb-5">
                            <div class="col-12 text-center">
                                <h1>Administración de Equipos</h1>
                            </div>
                        </div>
                        <div class="row  d-flex justify-content-center mb-4">
                            <div class="col-12 col-md-10">
                                <row>
                                    <div class="col-12 mb-5">
                                    <a href="producto_crear.php"
                                        class="btn btn-success btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i
                                            class="fas fa-plus-circle mr-2"></i> Nuevo Producto</a>
                                    </div>
                                    <div class="col-12">
                                    <table class="table table-striped table-hover table-sm display" id="tabla-data">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th class="text-center" style="white-space:nowrap;">Id</th>
                                                <th class="text-center" style="white-space:nowrap;">Marca</th>
                                                <th class="text-center" style="white-space:nowrap;">Modelo</th>
                                                <th class="text-center" style="white-space:nowrap;">Serie</th>
                                                <th class="text-center" style="white-space:nowrap;">Sistema Operativo</th>
                                                <th class="text-center" style="white-space:nowrap;">Ram</th>
                                                <th class="text-center" style="white-space:nowrap;">Disco</th>
                                                <th class="text-center" style="white-space:nowrap;">Costo</th>
                                                <th class="text-center" style="white-space:nowrap;">Notas</th>
                                                <th class="text-center" style="white-space:nowrap;">Imagen</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($equipos as $equipo) {
                                                echo('<tr>');
                                                echo('<td class="text-center">'.$equipo['id_productos'].'</td>');
                                                echo('<td class="text-center">'.$equipo['marca'].'</td>');
                                                echo('<td class="text-center" style="white-space:nowrap;">'.$equipo['modelo_equipo'].'</td>');
                                                echo('<td class="text-center">'.$equipo['serie'].'</td>');
                                                echo('<td class="text-center">'.$equipo['sist_op'].'</td>');
                                                echo('<td class="text-center">'.$equipo['ram'].'</td>');
                                                echo('<td class="text-center">'.$equipo['disco'].'</td>');
                                                echo('<td class="text-center" style="white-space:nowrap;"> $ '.number_format(floatval($equipo['costo']),2,'.',',').'</td>');
                                                echo('<td class="text-center">'.$equipo['nota'].'</td>');
                                                echo('<td class="text-center">');
                                                //===========================================================
                                                //Fotos
                                                //Trae las Fotos
                                                $query ="SELECT * FROM `fotos` WHERE `id_productos` = '" . $equipo['id_productos'] ."'";
                                                $result = mysqli_query($conexion,$query);
                                                $fotos = $result->fetch_all(MYSQLI_ASSOC);

                                                //===========================================================
                                                echo('<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">');
                                                echo('<div class="carousel-inner">');
                                                $cont =0;
                                                foreach ($fotos as $foto) {
                                                    $cont++;
                                                    if ($cont==1) {
                                                        echo('<div class="carousel-item active">');
                                                        echo('<img src="./imagenes/'.$foto['url'].'" class="d-block w-100" style="max-height:120px;max: width 120px;" alt="...">');
                                                        echo('</div>');
                                                    } else {
                                                        echo('<div class="carousel-item">');
                                                        echo('<img src="./imagenes/'.$foto['url'].'" class="d-block w-100" style="max-height:120px;max: width 120px;" alt="...">');
                                                        echo('</div>');
                                                    }
                                                }
                                                echo('</div>');
                                                echo('</div>');
                                                echo('</td>');
                                                echo('<td class="text-center" style="white-space:nowrap;">');
                                                echo('<a href="producto_editar.php?id_productos='.$equipo['id_productos'].'" class="btn-accion-tabla tooltipsC text-info" title="Editar">');
                                                echo('<i class="fas fa-edit" aria-hidden="true"></i></a>');
                                                echo('<form action="procesos.php" class="d-inline form-eliminar" method="GET">');
                                                echo('<input type="hidden" name="metodo" value="eliminar">');
                                                echo('<input type="hidden" name="id_productos" value="'.$equipo['id_productos'].'">');
                                                echo('<button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">');
                                                echo('<i class="fa fa-fw fa-trash text-danger"></i>');
                                                echo('</button>');
                                                echo('</form>');
                                                echo('</td>');
                                                echo('</tr>');
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </row>
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
    <script>
		window.onload=function() {
        <?php
        if ($_GET['registrado'] =='1') {
            echo("
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Equipo Registrado Correctamente',
                showConfirmButton: false,
                timer: 1500
              });
            ");
        } elseif ($_GET['editado'] =='1') {
            echo("
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Equipo Editado Correctamente',
                showConfirmButton: false,
                timer: 1500
              });
            ");
        }
        
        ?>
    }
		</script>    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>