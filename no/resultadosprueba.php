<?php
session_start();
require("pdo.php");
require("respuestasCorrectas.php");


$rol=$_SESSION["rol"];
if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
    echo "<script>location.href='index.php';</script>";
  }

$mostrarResultados="none";
$errorDni="";
$ocultar="block";
$mostrar="none";

  

if($_POST){

     //consulto resultados raven y calculo cantidad de respuestas correctas                     
     $consultaTest1 = $baseDeDatos-> prepare  ("SELECT dni, uno, dos, tres, cuatro, cinco, seis, 
     siete, ocho, nueve, diez, once, doce, trece, catorce, quince, dieciseis, diecisiete, dieciocho,
     diecinueve, veinte, veintiuno, veintidos, veintitres, veinticuatro, veinticinco, veintiseis,
     veintisiete, veintiocho, veintinueve, treinta, treintayuno, treintaydos, treintaytres, treintaycuatro,
     treintaycinco, treintayseis, treintaysiete, treintayocho, treintaynueve, cuarenta, cuarentayuno, cuarentaydos,
     cuarentaytres, cuarentaycuatro, cuarentaycinco, cuarentayseis, cuarentaysiete, cuarentayocho, cuarentaynueve, cincuenta,
     cincuentayuno, cincuentaydos, cincuentaytres, cincuentaycuatro, cincuentaycinco, cincuentayseis, cincuentaysiete,
     cincuentayocho, cincuentaynueve, sesenta
     from test1");
    $consultaTest1->execute();
    $datosTest1 =$consultaTest1 -> fetchAll(PDO::FETCH_ASSOC);

    
       
    foreach($datosTest1 as $usuario){
        
    $comparacionTest1 = array_intersect_assoc($test1, $usuario);
    $correctasTest1 = [$usuario['dni'],count($comparacionTest1)];


    foreach($correctasTest1 as $respuestas=>$key){
        echo $respuestas[0];
        echo $key;
        echo "<br>";
    }
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
    <link href="css/styles.css" rel="stylesheet">
   
  </head>
  <body>
        <div class="row justify-content-center">
            <main class="col-10 col-md-6">        
                    <nav class="row header align-items-center">
                        <h3 class="col-6">¡Hola <?php echo $_SESSION["name"]?>!</h3>
                        <a class="col-6" href="cerrarSesion.php">Cerrar Sesión</a>
                    </nav> 
                    <h4 class="centrarTexto">Consultar Resultados</h4>
                            <br>
                    <form class="formulario" style="display:<?php echo $ocultar?>" action="resultadosprueba.php" method="POST">
                          
                            <div class="row justify-content-around">  
                                <input  class="col-6" type="submit" class="botonConsultar" name="consultarTodos" value="Consultar Todos">
                            </div>    
                            <div class="error"> 
                                    <?php echo $errorDni?> 
                            </div>    


                                                              
                    </form> 
                    <div style="display:<?php echo $mostrar?>">
                            <br>
                            <div class="row fwb purple centrarTexto justify-content-around">
                                    <div class="col-2">
                                        Nombre
                                    </div> 
                                    <div class="col-2">
                                        Apellido
                                    </div>
                                    <div class="col-2">
                                        DNI
                                    </div> 
                                    <div class="col-2">
                                        Raven
                                    </div> 
                                    <div class="col-2">
                                        Texto
                                    </div> 
                            </div>  
                            <br>
                            <div class="row purple centrarTexto justify-content-around">
                                    <div class="col-2">
                                        <?php echo $nombre?>
                                    </div> 
                                    <div class="col-2">
                                        <?php echo $apellido?>
                                    </div>
                                    <div class="col-2">
                                        <?php echo $dni2?>
                                    </div> 
                                    <div class="col-2">
                                        <?php echo $correctasTest1?>
                                    </div> 
                                    <div class="col-2">
                                        <?php echo $totalAreas?>
                                    </div> 
                            </div>    
                                        
                    </div>
                    <br>
                    <br>
                    <div class="row justify-content-center"> 
                            <div class="col-12 centrarTexto">
                                <a class="purple" href="resultados.php">Nueva Consulta</a>
                            </div>
                            <div class="col-12 centrarTexto">
                                <a class="purple" href="admin.php">Menú anterior</a>
                            </div>
                    </div>         
        </main>
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>