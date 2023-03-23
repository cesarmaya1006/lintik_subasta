<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if (isset($_SESSION['pefil'], $_SESSION['id'])) {
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = substr($url, 0, 24);
    $_SESSION['url'] = $url;
    if ($url == 'localhost/login-register') {
        $urlRetorno = './';
    } else {
        $urlRetorno = 'https://dona.linktic.com/';
    }
    include './php/conexion_be.php';
    //===========================================================

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        print_r($_POST['email']);
        //print_r($_FILES);
        //die();
        $accion = $_POST['accion'];
        if ($accion == 'insertar') {
            //===========================================================
            //Categorias
            //Trae las categorias
            $query =
                "SELECT `categoria` FROM `categorias` WHERE `id_cat` = '" .
                $_POST['id_cat'] .
                "'";
            $result = mysqli_query($conexion, $query);
            $categorias = $result->fetch_all(MYSQLI_ASSOC);
            $marca = $categorias[0]['categoria'];
            //===========================================================
            //Manejo de archivo
            $archivo = $_FILES['archivo']['name'];
            if (isset($archivo) && $archivo != '') {
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                if (move_uploaded_file($temp, 'imagenes/' . $archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('imagenes/' . $archivo, 0777);
                }
            }
            //===========================================================
            $query =
                "INSERT INTO `productos`(
                `id_cat`,
                 `marca`, 
                 `modelo_equipo`, 
                 `serie`, 
                 `sist_op`, 
                 `ram`, 
                 `disco`, 
                 `costo`, 
                 `nota`, 
                 `url`, 
                 `estado`) 
                 VALUES (
                    '" .
                $_POST['id_cat'] .
                "',
                    '" .
                $marca .
                "',
                    '" .
                $_POST['modelo_equipo'] .
                "',
                    '" .
                $_POST['serie'] .
                "',
                    '" .
                $_POST['sist_op'] .
                "',
                    '" .
                $_POST['ram'] .
                "',
                    '" .
                $_POST['disco'] .
                "',
                    '" .
                $_POST['costo'] .
                "',
                    '" .
                $_POST['nota'] .
                "',
                    '" .
                $archivo .
                "',
                    1)";
            $result = mysqli_query($conexion, $query);
            header(
                'location: ' .
                    $urlRetorno .
                    'equipos.php?registrado=1&editado=0'
            );
        } elseif ($accion == 'editar') {
            //===========================================================
            //Categorias
            //Trae las categorias
            $query =
                "SELECT `categoria` FROM `categorias` WHERE `id_cat` = '" .
                $_POST['id_cat'] .
                "'";
            $result = mysqli_query($conexion, $query);
            $categorias = $result->fetch_all(MYSQLI_ASSOC);
            $marca = $categorias[0]['categoria'];
            //===========================================================
            //Manejo de archivo
            $archivo = $_FILES['archivo']['name'];
            if (isset($archivo) && $archivo != '') {
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                if (move_uploaded_file($temp, 'imagenes/' . $archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('imagenes/' . $archivo, 0777);
                }
            }
            //===========================================================
            $query =
                "UPDATE `productos` SET 
            `id_cat`='" .
                $_POST['id_cat'] .
                "',
            `marca`='" .
                $marca .
                "',
            `modelo_equipo`='" .
                $_POST['modelo_equipo'] .
                "',
            `serie`='" .
                $_POST['serie'] .
                "',
            `sist_op`='" .
                $_POST['sist_op'] .
                "',
            `ram`='" .
                $_POST['ram'] .
                "',
            `disco`='" .
                $_POST['disco'] .
                "',
            `costo`='" .
                $_POST['costo'] .
                "',
            `nota`='" .
                $_POST['nota'] .
                "'";
            if (isset($archivo) && $archivo != '') {
                $query .= ",`url`='" . $archivo . "'";
            }
            $query .= "WHERE `id_productos` = '" . $_POST['id_productos'] . "'";
            $result = mysqli_query($conexion, $query);
            header(
                'location: ' .
                    $urlRetorno .
                    'equipos.php?registrado=0&editado=1'
            );
        } elseif ($accion == 'agregar') {
            //===========================================================
            //===========================================================
            //Manejo de archivo
            $archivo = $_FILES['archivo']['name'];
            if (isset($archivo) && $archivo != '') {
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                if (move_uploaded_file($temp, 'imagenes/' . $archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('imagenes/' . $archivo, 0777);
                }
            }
            //===========================================================
            $query =
                "INSERT INTO `fotos`(
                 `id_productos`,
                  `url`) 
                  VALUES (
                     '" .
                $_POST['id_productos'] .
                "',
                     '" .
                $archivo .
                "')";
            $result = mysqli_query($conexion, $query);
            header(
                'location: ' .
                    $urlRetorno .
                    'producto_editar.php?id_productos=' .
                    $_POST['id_productos']
            );
        } elseif ($accion == 'eliminar_foto') {
            //===========================================================
            $id_foto = $_POST['id_foto'];
            //===============================================================
            $query =
                "SELECT `url` FROM `fotos`WHERE `id_foto` = '" . $id_foto . "'";
            $result = mysqli_query($conexion, $query);
            $fotos = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($fotos as $foto) {
                $url = $foto['url'];
                $url_borrar = 'imagenes/' . $url;
                $url_borrar = rtrim($url_borrar);
                unlink($url_borrar);
            }
            //================================================================
            $query = "DELETE FROM `fotos` WHERE `id_foto` = '" . $id_foto . "'";
            $result = mysqli_query($conexion, $query);
            header(
                'location: ' .
                    $urlRetorno .
                    'producto_editar.php?id_productos=' .
                    $_POST['id_productos']
            );
        } elseif ($accion == 'recuperar') {
            print_r($_POST['email']);
            $query =
                "SELECT * FROM `usuarios` WHERE `correo` = '" .
                $_POST['email'] .
                "'";
            $result = mysqli_query($conexion, $query);
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            if (count($usuarios) > 0) {
                foreach ($usuario as $usuario_) {
                    $usuario = $usuario_;
                }
                $mystring = $_POST['email'];
                $findme = '@';
                $pos = strpos($mystring, $findme);
                $resultado = substr($mystring, 0, $pos);
                print_r($mystring);
                //die();
                $query =
                    "UPDATE `usuarios` SET `camb_password`='1',`remember_token`='' WHERE id='" .
                    $usuario['id'] .
                    "'";
            }
            header('location: ' . $urlRetorno);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ) {
            $metodo = $_GET['metodo'];
            if ($metodo == 'eliminar') {
                $id_productos = $_GET['id_productos'];
                //===============================================================
                $query =
                    "SELECT `url` FROM `fotos` WHERE `id_productos` = '" .
                    $id_productos .
                    "'";
                $result = mysqli_query($conexion, $query);
                $fotos = $result->fetch_all(MYSQLI_ASSOC);
                if (count($fotos) > 0) {
                    foreach ($fotos as $foto) {
                        $url = $foto['url'];
                        $url_borrar = 'imagenes/' . $url;
                        $url_borrar = rtrim($url_borrar);
                        unlink($url_borrar);
                        $query =
                            "DELETE FROM `fotos` WHERE `id_productos` = '" .
                            $id_productos .
                            "'";
                        $result = mysqli_query($conexion, $query);
                    }
                }
                //================================================================
                $query =
                    "DELETE FROM `productos` WHERE `id_productos` = '" .
                    $id_productos .
                    "'";
                $result = mysqli_query($conexion, $query);
                //header("location: ../equipos.php?registrado=0&editado=1");
                $datos[] = 'eliminado';
                header('Content-type: text/json');
                echo json_encode($datos, JSON_PRETTY_PRINT);
            } elseif ($metodo == 'cargarfotos') {
                $id_productos = $_GET['id_productos'];
                //===============================================================
                $query =
                    "SELECT `url` FROM `fotos` WHERE `id_productos` = '" .
                    $id_productos .
                    "'";
                $result = mysqli_query($conexion, $query);
                $fotos = $result->fetch_all(MYSQLI_ASSOC);
                $datos[] = 'sipi';
                header('Content-type: text/json');
                echo json_encode($datos, JSON_PRETTY_PRINT);
            } elseif ($metodo == 'eliminar_compra') {
                $id_productos = $_GET['id_productos'];
                $id = $_GET['id'];
                //===============================================================
                $query =
                    "DELETE FROM `compras` WHERE `id_productos` = '" .
                    $id_productos .
                    "'  AND id='" .
                    $id .
                    "'";
                $result = mysqli_query($conexion, $query);
                $query =
                    'UPDATE `productos` SET `estado`= 1 WHERE `id_productos` = ' .
                    $id_productos;
                $result = mysqli_query($conexion, $query);
                $datos[] = 'eliminado';
                //===============================================================
                header('Content-type: text/json');
                echo json_encode($datos, JSON_PRETTY_PRINT);
            }
        }
    }
} else {
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = substr($url, 0, 24);
    $_SESSION['url'] = $url;
    if ($url == 'localhost/login-register') {
        $urlRetorno = './';
    } else {
        $urlRetorno = 'https://dona.linktic.com/';
    }
    include './php/conexion_be.php';
    //===========================================================

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //print_r($_FILES);
        //die();
        $accion = $_POST['accion'];

        if ($accion == 'recuperar') {
            $query =
                "SELECT * FROM `usuarios` WHERE `correo` = '" .
                $_POST['email'] .
                "'";

            $result = mysqli_query($conexion, $query);
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            if (count($usuarios) > 0) {
                foreach ($usuarios as $usuario_) {
                    $usuario = $usuario_;
                }
                $mystring = $_POST['email'];
                $email = $_POST['email'];
                $findme = '@';
                $pos = strpos($mystring, $findme);
                $resultado = substr($mystring, 0, $pos);
                $characters =
                    '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $pos; $i++) {
                    $randomString .=
                        $characters[random_int(0, $charactersLength - 1)];
                }
                $encriptado = hash('sha512', $resultado . $randomString);
                $query = "UPDATE `usuarios` SET `camb_password`='1',`remember_token`='" . $encriptado ."' WHERE id='" . $usuario['id'] . "'";
                $result = mysqli_query($conexion, $query);
                $to = $email;
                $subject = "Restablecer contraseña";
                $message = "Haga clic en el siguiente enlace para restablecer su contraseña: http://".$url."/reset_password.php?email=" . $email . "&token=" . $encriptado;
                $headers = "From: linktic@linktic.com" . "\r\n" .
                            "Reply-To: " . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                if(mail($to, $subject, $message, $headers)){
                    $mensaje ="El correo envio de manera correcta";
                }else{
                    $mensaje ="No se pudo enviar el correo";
                }
            }else{
                $mensaje ="El correo no se encuentra registrado en la base de datos";
            }
            $_SESSION['mensaje'] = $mensaje;
            header('location: ' . $urlRetorno);
        }elseif($accion =='new_password'){
            $query = "UPDATE `usuarios` SET `camb_password`='0',`remember_token`='1',`Pass`='" . $_POST['password'] . "' WHERE correo='" . $_POST['email'] . "' AND remember_token='" . $_POST['token'] . "'";
            $result = mysqli_query($conexion, $query);
            $mensaje_camb ="Se cambio la contraseña de manera correcta";
            $_SESSION['mensaje_camb'] = $mensaje;
            header('location: ' . $urlRetorno);

        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ) {
            $metodo = $_GET['metodo'];
        }
    }
}

?>
