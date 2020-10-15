<?php
session_start();
require("pdo.php"); 

$rol=$_SESSION["rol"];
$dni=$_SESSION["dni"];


if($_POST){
    if($rol == "postulante"){
        $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET test1 =-1 WHERE dni = '$dni'");
        $consulta->execute();
    }
    $_SESSION['tiempo']=time();
   
    @$fecha = date("Y-m-d H:i:s",time());
    $date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $zonahoraria = date_default_timezone_get();
    @$fecha=date("H:i",time());


    $_SESSION["inicio"] = $fecha;
    
    
    $consulta2 = $baseDeDatos-> prepare
        ("UPDATE usuarios SET horaRaven = '$fecha' WHERE dni = '$dni'");
    $consulta2->execute();

    echo "<script>location.href='testr.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Test 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/index.css" rel="stylesheet">
  </head>
  <body>
      
    <div class="row justify-content-center">
      <main class="col-12 col-md-6 col-xl-4 cajaIndex">
              
      
            <h6 style="color:purple;margin-top:100px; margin-bottom:100px; font-weight: bolder; text-align:justify">
            Siguiendo el orden numérico observá el dibujo, elegí la figura que lo completa y seleccioná la opción
             que consideres correcta. 
             <br>Son 60 niveles y tendrás 45 minutos para completarlo.
             <br>
            Si lo deseas, podrás avanzar al siguiente nivel sin seleccionar ninguna opción y luego volver al nivel que te haya faltado. 
            </h6>
            <div class="row justify-content-center">
                <form method="POST" action="empezarTest.php">
                    <input class="boton-comenzar" name="comenzar" type="submit" value="Comenzar">
                </form> 
            </div>       
      </main>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>


