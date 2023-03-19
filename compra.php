<?php
session_start();
$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$url = substr($url,0,24);
$_SESSION['url'] = $url;
if ($url =='localhost/login-register') {
    $urlRetorno ='./';
}else{
    $urlRetorno ='https://dona.linktic.com/';
}
include('./php/conexion_be.php');
//===========================================================
//print_r($_POST);
//===========================================================
//Compra
//Insertar en la tabla compra la transaccion
$query ="INSERT INTO `compras`(`id_productos`, `id`) VALUES ('".$_POST['id_productos']."','".$_POST['id']."')";
$result = mysqli_query($conexion,$query);

$query ="UPDATE `productos` SET `estado`='0' WHERE `id_productos` = '".$_POST['id_productos']."'";
$result = mysqli_query($conexion,$query);
$_SESSION['aporte'] = 1;
header("location: ".$urlRetorno."bienvenida2.php");