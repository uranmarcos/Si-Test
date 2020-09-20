<?php
session_start();
require("pdo.php");   
require("respuestasCorrectas.php");  
$rol = $_SESSION["rol"];
$dni = $_SESSION["dni"];
$mensaje = "¡Listo! Ya transcurrió el tiempo disponible.
            <br> Se guardaron las respuestas que hayas seleccionado hasta ahora.
            <br> ¡Gracias!";



if($rol == "postulante"){
      $volver = "menu.php";
      $consulta = $baseDeDatos-> prepare
            ("UPDATE usuarios SET areas = -2 WHERE dni = '$dni'");
      $consulta->execute();
}elseif($rol == "voluntario"){
      $volver = "admin.php";
}


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sí</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/admin.css" rel="stylesheet">
  
  </head>
  <body>
      <div class="row justify-content-center ">
          <main class="col-10 col-md-6 align-items-center">
              <h5 class="centrarTexto"> 
                  <?php echo $mensaje?>
              </h5>
              <br>
              <div class="centrarTexto" > 
                  <a href="<?php echo $volver?>"> Continuar</a>
              </div>    
          </main>
      </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>