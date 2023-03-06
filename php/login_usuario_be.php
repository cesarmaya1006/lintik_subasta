<?php
include 'conexion_be.php';
session_start();
$_SESSION = array();
$_SESSION['perfil'] ='';
$correo = $_POST['Correo'];
$contraseña = $_POST['Passw'];
unset($perfil);

$contraseña = hash('sha512',$contraseña);
$verificar_login = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario ='$correo' AND Pass = '$contraseña'"); 
$usuarios = $verificar_login->fetch_all(MYSQLI_ASSOC);
$id_usuario =0;
foreach ($usuarios as $usuario) {
    $id_usuario=$usuario['id'];
    $perfil = $usuario['perfil'];
}

//die("SELECT * FROM usuarios WHERE usuario ='$correo' AND Pass = '$contraseña'");
if(mysqli_num_rows($verificar_login) > 0){
    $_SESSION = array();
    $_SESSION['pefil'] = $perfil;
    if ($_SESSION['pefil']=='admin') {
        header("location: ../asignacion.php");
    } else {
        header("location: ../bienvenida2.php?id_usuario=".$id_usuario);
    }
    
exit;
}else{
    echo'
    <script>
    alert("Usuario no existente");
    window.location = "../index.php";
    </script>
    ';
    exit;
}

?>