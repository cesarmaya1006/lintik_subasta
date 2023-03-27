<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="col-12">
        <p>Haga clic en el siguiente enlace para restablecer su contraseña: 
            <a href="http://<?php echo($_GET['url'])?>/reset_password.php?email=<?php echo($_GET['email'])?>&token=<?php echo($_GET['encriptado'])?>">Restablecer Contraseña</a>
        </p>
    </div>
</div>    
</body>
</html>