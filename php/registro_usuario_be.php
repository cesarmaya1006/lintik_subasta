<?php
//Conexion a la BD
include 'conexion_be.php';
//Control de dominos
$dominios = [
    '3Tcapital.co',
    'andresforero.co',
    'Miguelgutierrez.com.co',
    'Nataliabedoya.com.co',
    'eduklab.co',
    'expone.co',
    'Hicome.co',
    'joseluiscorrea.co',
    'Keepsalud.co',
    'Quierovenderenlinea.co',
    'Tictur.org',
    'Tuvitrina.co',
    'vendeporinternet.co',
    'Wimbu.co',
    'Yaktil.co',
    'linktic.com',

];
//Creacion de variables
$nombre_completo = $_POST['Nombre_completo'];
$correo = $_POST['Correo'];
$usuario = $_POST['Usuario'];
$contraseña = $_POST['Passw'];
//Verificar Dominio
$findme = '@';
$pos = strpos($correo, $findme);
if ($pos !== false) {
    $arrobaValida = 1;
} else {
    $arrobaValida = 0;
}
$dominio = substr($correo, $pos + 1, $largo);
$largo = strlen($correo);
$controlDominio = 0;
foreach ($dominios as $dominioArray) {
    if ($dominioArray == $dominio) {
        $controlDominio = 1;
    }
}
if (!$controlDominio) {
    echo ' 
    <script>
    alert ("Dominio no autorizado");
    window.location ="../index.php";
    </script>
    ';
    exit();
} else {
    //Encriptar contraseña
    $contraseña = hash('sha512', $contraseña);
    $query = "INSERT INTO usuarios(nombre_completo,correo,usuario,Pass)
          VALUES ('$nombre_completo','$correo','$usuario','$contraseña')";

    //verificar el correo que no se repita en la BD

    $verificar_correo = mysqli_query(
        $conexion,
        "SELECT * FROM usuarios WHERE correo ='$correo'"
    );
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo ' 
    <script>
    alert ("Correo existente");
    window.location ="../index.php";
    </script>
    ';
        exit();
    }

    $verificar_usuario = mysqli_query(
        $conexion,
        "SELECT * FROM usuarios WHERE usuario ='$usuario'"
    );
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo ' 
    <script>
    alert ("usuario existente");
    window.location ="../index.php";
    </script>
    ';
        exit();
    }
    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '
    <script>
    alert ("Usuario almacenado correctamente");
    window.location ="../index.php";
    </script>
    ';
    } else {
        echo '
        <script>
        alert ("ERROR");
        window.location ="../index.php";
        </script>
        ';
    }
}
mysqli_close($conexion);

?>
