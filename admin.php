<?php
session_start();
require("pdo.php");
$dni=$_SESSION["dni"];
$rol=$_SESSION["rol"];

if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
  echo "<script>location.href='index.php';</script>";
}


//desabilito opciones de test si ya los hizo
      
      $ocultarArea3 = 2;
      $ocultarArea6 = 2;  
      
      //redirecciono en base a la opción elegida
      if($_POST){
        if(isset($_POST["raven"])){
          echo "<script>location.href='empezarTest.php';</script>";
        }elseif(isset($_POST["area2"])){
          echo "<script>location.href='area2.php';</script>";
        }elseif(isset($_POST["area3"])){
          echo "<script>location.href='area3.php';</script>";
        }elseif(isset($_POST["area6"])){
          echo "<script>location.href='area6.php';</script>";
        }elseif(isset($_POST["area8"])){
          echo "<script>location.href='area8.php';</script>";
        }elseif(isset($_POST["area9"])){
          echo "<script>location.href='area9.php';</script>";
        }elseif(isset($_POST["usuarios"])){
          echo "<script>location.href='usuarios.php';</script>";
        }elseif(isset($_POST["password"])){
          echo "<script>location.href='password.php';</script>";
        }elseif(isset($_POST["test"])){
          echo "<script>location.href='test.php';</script>";
        }elseif(isset($_POST["resultados"])){
          echo "<script>location.href='resultados.php';</script>";
        }elseif(isset($_POST["estadisticas"])){
          echo "<script>location.href='estadisticas.php';</script>";
        }
        elseif(isset($_POST["help"])){
          echo "<script>location.href='help.php';</script>";
        }
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
    <link href="css/styles2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
  </head>
  <body class="container">
      <header class="row fwb purple header align-items-center">
              <h4 class="col-6 centrarTexto">¡Hola <?php echo $_SESSION["name"]?>!</h4>
              <a class="col-6 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
      </header>
      <div class="row justify-content-center cajaPrincipal">
          <aside class="col-10 col-md-3">
              <?php include("aside.php")?>     
          </aside>
          <main class="col-10 col-md-9">
        
                      
          </main>
      </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>