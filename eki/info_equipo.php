<?php
include 'conexion_be.php';

$id_producto = $_POST['id_productos'];
$marca = $_POST['marca'];
$modelo_equipo = $_POST['modelo_equipo'];
$serie = $_POST['serie'];
$costo = $_POST['costo'];


$query = "INSERT INTO productos(id,marca,modelo_equipo,serie,costo)
          VALUES ('101','Lenovo','ThinkPad E480','PF1815VQ','230.000')";

?>