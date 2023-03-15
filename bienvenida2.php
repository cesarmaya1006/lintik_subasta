<?php
session_start();
if (isset($_SESSION['pefil'],$_SESSION['id'])) {
    $ingresa =1;
}else{
    $ingresa =0;
}

if ($ingresa==0) {
    echo '
    <script>
    alert ("Usuario no Logeado");
    window.location ="index.php";
    </script>
    ';
}

include('./php/conexion_be.php');
//===========================================================
//Usuario
//Trae las Usuario
$query ='SELECT * FROM `usuarios` WHERE `id` = '. $_GET['id_usuario'];
$result = mysqli_query($conexion,$query);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
foreach ($usuarios as $usuario_f) {
    $usuario=$usuario_f;
}
//===========================================================
//===========================================================
//Categorias
//Trae las categorias
$query ='SELECT * FROM `categorias`';
$result = mysqli_query($conexion,$query);
$categorias = $result->fetch_all(MYSQLI_ASSOC);
//===========================================================
//Equipos
$query ='SELECT * FROM `productos`';
$result = mysqli_query($conexion,$query);
$equipos = $result->fetch_all(MYSQLI_ASSOC);



?>
<style>

    .card{
        -webkit-box-shadow: 6px 6px 2px 0px rgba(255, 255, 255, 0.75);
        -moz-box-shadow: 6px 6px 2px 0px rgba(255, 255, 255, 0.75);
        box-shadow: 6px 6px 2px 0px rgba(255, 255, 255, 0.75);
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: 30px;
        border-radius: 5px;
    }
    .marca-de-agua::after {
        content: "No Disponible"; 
        font-size: 1.5em;  
        color: rgba(0,0,0, 0.9);
        z-index: 9999;
 
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        top: 200;
        right: 0;
        bottom: 0;
        left: 0;
    
        -webkit-pointer-events: none;
        -moz-pointer-events: none;
        -ms-pointer-events: none;
        -o-pointer-events: none;
        pointer-events: none;

        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
}
.subastado {
    padding: 0;
    width: 100%;
    height: auto;
    opacity: 0.5;
}
body{
        margin: 0;
    }
</style>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="./imagenes/logo.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" 
    integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://kit.fontawesome.com/e00ad09966.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Linktic</title>
  </head>
  <body>
    <div>
        <div class="row" style="min-height: 100vh;">
            <div class="col-12" style="min-height: 100vh;background-color: rgba(0, 255, 255, 0);">
                <div class="row" style="background-color: rgba(0,0, 0, 0.75);">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center d-flex flex-row justify-content-between">
                                <img class="img-fluid float-end" src="./imagenes/logofull.png" style="max-height: 80px;" alt="">
                                <h1 class="text-white mt-4">Contribuciones LinkTIC</h1>
                                <img class="img-fluid float-start" src="./imagenes/logofull.png" style="max-height: 80px;" alt="">
                            </div>
                            <div class="col-12">
                                <a class="btn btn-success pl-5 pr-5 float-end" style="min-width: 250px;" href="./php/unlogin.php">Salir</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center" 
                    style="background-image: url('./imagenes/logofull.png');
                           background-attachment: fixed;
                           background-position: center;
                           background-repeat: no-repeat;
                           background-size: cover;
                           background-size: 600px;">
                    <div class="col-12">
                        <div class="row d-flex justify-content-center" style="background-color: rgba(255,255,255,0.5); min-height:75vh">
                            <div class="col-12 col-md-10">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php
                                        $contador =0;
                                        foreach ($categorias as $categoria) {
                                            //Equipos
                                            $query ='SELECT * FROM `productos` WHERE `id_cat`='.$categoria['id_cat'];
                                            $result = mysqli_query($conexion,$query);
                                            $equipos = $result->fetch_all(MYSQLI_ASSOC);
                                            if (count($equipos)>0) {
                                                $contador++;
                                                if ($contador ==1) {
                                                    echo('<button class="nav-link active nav-Light nav_menu" id="nav-'.$categoria['categoria'].'-tab" data-bs-toggle="tab" data-bs-target="#nav-'.$categoria['categoria'].'" type="button" role="tab" aria-controls="nav-'.$categoria['categoria'].'" aria-selected="true">'.$categoria['categoria'].'</button>');
                                                } else {
                                                    echo('<button class="nav-link nav-Light nav_menu" id="nav-'.$categoria['categoria'].'-tab" data-bs-toggle="tab" data-bs-target="#nav-'.$categoria['categoria'].'" type="button" role="tab" aria-controls="nav-'.$categoria['categoria'].'" aria-selected="false">'.$categoria['categoria'].'</button>');
                                                }
                                            }
                                        }
                                    ?>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                <?php
                                    $contador =0;
                                    foreach ($categorias as $categoria) {
                                        //Equipos
                                        $query ='SELECT * FROM `productos` WHERE `id_cat`='.$categoria['id_cat'];
                                        $result = mysqli_query($conexion,$query);
                                        $equipos = $result->fetch_all(MYSQLI_ASSOC);
                                        if (count($equipos)>0) {
                                            $contador++;
                                            if ($contador ==1) {

                                                echo('<div class="tab-pane fade show active" id="nav-'.$categoria['categoria'].'" role="tabpanel" aria-labelledby="nav-'.$categoria['categoria'].'-tab">');

                                                $contador2 =0;
                                                echo('<div class="row d-flex justify-content-evenly p_md-5">');
                                                foreach ($equipos as $equipo) {
                                                    if ($equipo['id_cat'] == $categoria['id_cat']) {
                                                        $contador2++;
                                                        echo('<div class="col-12 col-md-4 p-1 m-md-5">');
                                                        echo('<div class="card w-100">');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 p-4 d-flex justify-content-center">');
                                                        //===========================================================
                                                        //Fotos
                                                        //Trae las Fotos
                                                        $query ="SELECT * FROM `fotos` WHERE `id_productos` = '" . $equipo['id_productos'] ."'";
                                                        $result = mysqli_query($conexion,$query);
                                                        $fotos = $result->fetch_all(MYSQLI_ASSOC);

                                                        //===========================================================
                                                        echo('<div id="carouselExampleSlidesOnly'.$equipo['id_productos'].'" class="carousel slide" data-bs-ride="carousel">');
                                                        echo('<div class="carousel-inner" id="carrusel_inner_'.$equipo['id_productos'].'">');
                                                        $cont =0;
                                                        if (count($fotos)>0) {
                                                            foreach ($fotos as $foto) {
                                                                $cont++;
                                                                if ($cont==1) {
                                                                    echo('<div class="carousel-item active">');
                                                                    if ($equipo['estado']==0) {
                                                                        echo('<div class="marca-de-agua"></div>');
                                                                    }
                                                                    echo('<img src="imagenes/'.$foto['url'].'" class="img-thumbnail');
                                                                    if ($equipo['estado']==0) {
                                                                        echo(' subastado');
                                                                    }
                                                                    echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;"  >');
                                                                    echo('</div>');
                                                                } else {
                                                                    echo('<div class="carousel-item">');
                                                                    if ($equipo['estado']==0) {
                                                                    echo('<div class="marca-de-agua"></div>');
                                                                    }
                                                                    echo('<img src="imagenes/'.$foto['url'].'" class="img-thumbnail');
                                                                    if ($equipo['estado']==0) {
                                                                        echo(' subastado');
                                                                    }
                                                                    echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;"  >');
                                                                    echo('</div>');
                                                                }
                                                            }
                                                        } else {
                                                            echo('<div class="carousel-item active">');
                                                            echo('<img src="imagenes/Imagen_no_disponible.png" class="img-thumbnail');
                                                            echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;">');
                                                            echo('</div>');
                                                        }
                                                        echo('</div>');
                                                        echo('<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">');
                                                        echo('<span class="carousel-control-prev-icon" aria-hidden="true"></span>');
                                                        echo('<span class="visually-hidden">Previous</span>');
                                                        echo('</button>');
                                                        echo('<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">');
                                                        echo('<span class="carousel-control-next-icon" aria-hidden="true"></span>');
                                                        echo('<span class="visually-hidden">Next</span>');
                                                        echo('</button>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 text-center">');
                                                        echo('<span type="button" class="btn btn-primary" onclick="verModal('.$equipo['id_productos'].')"><i class="fas fa-search"></i></span>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('<div class="card-body">');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 text-center">');
                                                        echo('<h5 class="card-title">Pc '.$contador2.'</h5>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('<hr>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Marca : </strong></div><div class="col-8"><p>'.$equipo['marca'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Modelo : </strong></div><div class="col-8"><p>'.$equipo['modelo_equipo'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Serial : </strong></div><div class="col-8"><p>'.$equipo['serie'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Sistema Operativo : </strong></div><div class="col-7"><p>'.$equipo['sist_op'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Ram : </strong></div><div class="col-8"><p>'.$equipo['ram'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Disco duro : </strong></div><div class="col-8"><p>'.$equipo['disco'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>NOTA : </strong></div><div class="col-8" style="font-size:0.9em;"><p>'.$equipo['nota'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Contribución : </strong></div><div class="col-8"><p>$ '.number_format($equipo['costo'],2,'.',',').'</p></div></div>');
                                                        echo('<div class="row mt-5"><div class="col-12 d-grid gap-2 col-md-6 mx-auto">');
                                                        echo('<form action="compra.php" method ="POST">');
                                                        echo('<input type="hidden" name="id_productos" value="'.$equipo['id_productos'].'">  ');
                                                        echo('<input type="hidden" name="id" value="'.$usuario['id'].'">');
                                                        echo('<div class="d-grid gap-2">');echo('<button type="submit" class="btn btn-primary" style="$cyan-500;box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.75);" ');
                                                        if ($equipo['estado']==0) {
                                                            echo(' disabled');
                                                        }
                                                        echo('>  -- Aportar --  </button>  ');
                                                        echo('</div>');
                                                        echo('</form>');
                                                        echo('</div></div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                    }
                                                }
                                                echo('</div>');
                                                echo('</div>');
                                            } else {
                                                echo('<div class="tab-pane fade" id="nav-'.$categoria['categoria'].'" role="tabpanel" aria-labelledby="nav-'.$categoria['categoria'].'-tab">');
                                                $contador2 =0;
                                                echo('<div class="row d-flex justify-content-evenly">');
                                                foreach ($equipos as $equipo) {
                                                    if ($equipo['id_cat'] == $categoria['id_cat']) {
                                                        $contador2++;
                                                        echo('<div class="col-12 col-md-4 p-1 m-md-5">');
                                                        echo('<div class="card w-100">');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 p-4 d-flex justify-content-center">');
                                                        //===========================================================
                                                        //Fotos
                                                        //Trae las Fotos
                                                        $query ="SELECT * FROM `fotos` WHERE `id_productos` = '" . $equipo['id_productos'] ."'";
                                                        $result = mysqli_query($conexion,$query);
                                                        $fotos = $result->fetch_all(MYSQLI_ASSOC);

                                                        //===========================================================
                                                        echo('<div id="carouselExampleSlidesOnly'.$equipo['id_productos'].'" class="carousel slide" data-bs-ride="carousel">');
                                                        echo('<div class="carousel-inner" id="carrusel_inner_'.$equipo['id_productos'].'">');
                                                        $cont =0;
                                                        if (count($fotos)>0) {
                                                            foreach ($fotos as $foto) {
                                                                $cont++;
                                                                if ($cont==1) {
                                                                    echo('<div class="carousel-item active">');
                                                                    if ($equipo['estado']==0) {
                                                                        echo('<div class="marca-de-agua"></div>');
                                                                    }
                                                                    echo('<img src="imagenes/'.$foto['url'].'" class="img-thumbnail');
                                                                    if ($equipo['estado']==0) {
                                                                        echo(' subastado');
                                                                    }
                                                                    echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;" >');
                                                                    echo('</div>');
                                                                } else {
                                                                    echo('<div class="carousel-item">');
                                                                    if ($equipo['estado']==0) {
                                                                    echo('<div class="marca-de-agua"></div>');
                                                                    }
                                                                    echo('<img src="imagenes/'.$foto['url'].'" class="img-thumbnail');
                                                                    if ($equipo['estado']==0) {
                                                                        echo(' subastado');
                                                                    }
                                                                    echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;" >');
                                                                    echo('</div>');
                                                                }
                                                            }
                                                        } else {
                                                            echo('<div class="carousel-item active">');
                                                            echo('<img src="imagenes/Imagen_no_disponible.png" class="img-thumbnail');
                                                            echo('" alt="'.$equipo['modelo_equipo'].'" style="height:250px;width:auto;">');
                                                            echo('</div>');
                                                        }
                                                        echo('</div>');
                                                        echo('<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">');
                                                        echo('<span class="carousel-control-prev-icon" aria-hidden="true"></span>');
                                                        echo('<span class="visually-hidden">Previous</span>');
                                                        echo('</button>');
                                                        echo('<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">');
                                                        echo('<span class="carousel-control-next-icon" aria-hidden="true"></span>');
                                                        echo('<span class="visually-hidden">Next</span>');
                                                        echo('</button>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 text-center">');
                                                        echo('<span type="button" class="btn btn-primary" onclick="verModal('.$equipo['id_productos'].')"><i class="fas fa-search"></i></span>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                       echo('<div class="card-body">');
                                                        echo('<div class="row">');
                                                        echo('<div class="col-12 text-center">');
                                                        echo('<h5 class="card-title">Pc '.$contador2.'</h5>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('<hr>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Marca : </strong></div><div class="col-8"><p>'.$equipo['marca'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Modelo : </strong></div><div class="col-8"><p>'.$equipo['modelo_equipo'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Serial : </strong></div><div class="col-8"><p>'.$equipo['serie'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Sistema Operativo : </strong></div><div class="col-7"><p>'.$equipo['sist_op'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Ram : </strong></div><div class="col-8"><p>'.$equipo['ram'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Disco duro : </strong></div><div class="col-8"><p>'.$equipo['disco'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>NOTA : </strong></div><div class="col-8" style="font-size:0.9em;"><p>'.$equipo['nota'].'</p></div></div>');
                                                        echo('<div class="row"><div class="col-4 text-end" style="font-size:0.85em;"><strong>Contribución : </strong></div><div class="col-8"><p>$ '.number_format($equipo['costo'],2,'.',',').'</p></div></div>');
                                                        echo('<div class="row mt-5"><div class="col-12 d-grid gap-2 col-md-6 mx-auto">');
                                                        echo('<form action="compra.php" method ="POST">');
                                                        echo('<input type="hidden" name="id_productos" value="'.$equipo['id_productos'].'">  ');
                                                        echo('<input type="hidden" name="id" value="'.$usuario['id'].'">');
                                                        echo('<div class="d-grid gap-2">');echo('<button type="submit" class="btn btn-primary" style="$cyan-500;box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.75);" ');
                                                        if ($equipo['estado']==0) {
                                                            echo(' disabled');
                                                        }
                                                        echo('>  -- Aportar --  </button>  ');
                                                        echo('</div>');
                                                        echo('</form>');
                                                        echo('</div></div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                        echo('</div>');
                                                    }
                                                }
                                                echo('</div>');
                                                echo('</div>');
                                            }
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imagenes Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-rounded mx-auto d-block" id="imagenesmodal">
            <div class="col-12 col-md-6 p-5">
                <img src="..." class="img-fluid">
            </div>
            <div class="col-12 col-md-6 p-5">
                <img src="..." class="img-fluid">
            </div>
            <div class="col-12 col-md-6 p-5">
                <img src="..." class="img-fluid">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


    <?php
$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$url = substr($url,0,24);
$_SESSION['url'] = $url;
if ($url =='localhost/login-register') {
    $urlRetorno ='http://localhost/login-register/procesos.php';
}else{
    $urlRetorno ='https://dona.linktic.com/procesos.php';
}

?>
<input type="hidden" name="" id="url_data" value="<?php echo($urlRetorno); ?>">
    <?php
    
if (isset($_GET['aporte'])) {
    echo("
    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Su aporte fue registrado',
        showConfirmButton: false,
        timer: 1500
      })
      </script>
    ");
    $_GET['aporte'] = 0;
}
    ?>
 

    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        function verModal(id_productos){
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            var hijos = $('#carrusel_inner_'+id_productos).find('img');
            html_ = '';
            hijos.each(function() { 
                html_+='<div class="col-12 p-5 mb-3"><img src="'+$(this).attr('src')+'" class="img-fluid rounded mx-auto d-block"></div>';
                console.log($(this).attr('src'));
            });
            $('#imagenesmodal').html(html_);
            $('.marca-de-agua').addClass('d-none');
            myModal.show();
        }
        $("#exampleModal").on("hidden.bs.modal", function () {
            $('.marca-de-agua').removeClass('d-none');
        });
    </script>
  </body>
</html>