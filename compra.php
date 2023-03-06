<?php
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


header("location: ../login-register/bienvenida2.php?id_usuario=".$_POST['id']."&aporte=1");