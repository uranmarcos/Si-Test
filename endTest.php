<?php
session_start();
require("pdo.php");     
$rol = $_SESSION["rol"];
$dni = $_SESSION["dni"];

//si no está logueado redirecciono a loguearse
if($_SESSION['autenticado']!="si"){
    echo "<script>location.href='index.php';</script>";
}

               
            $mensaje= "¡Listo! ¡Has terminado todas las actividades!";
            $password = rand(100000, 999999);
            $consulta = $baseDeDatos-> prepare
                      ("UPDATE usuarios SET password = '$password' WHERE dni = '$dni'");
            $consulta->execute();
            session_destroy(); 

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
                  <a href="index.php">Finalizar</a>
              </div>    
          </main>
      </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>