<?php
session_start();
require("pdo.php");
require("funcionesAdmin.php");


$rol=$_SESSION["rol"];
if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
    echo "<script>location.href='index.php';</script>";
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
        <link href="css/normalize.css" rel="stylesheet">
        <link href="css/adminStyles1.css" rel="stylesheet">
    </head>
    <body class="container">
        <header class="row fwb  header justify-content-between align-items-center">
            <h4 class="col-4 leftTexto">¡Hola <?php echo $_SESSION["name"]?>!</h4>
            <a class="col-4 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
        </header>  
        <div class="row justify-content-center cajaPrincipal">
            <aside class="col-10 aside col-md-3">
                <form class="row " action="admin.php" method="GET">
                    <div class="col-12 cajaMenu align-items-center">
                        <div class="botonMenuAdmin">
                            <a href="test/empezarTest.php" class="cajaBoton">Raven</a>
                        </div>
                        <div class="botonMenuAdmin">
                            <a href="test/area2.php" class="cajaBoton">Área 2</a>
                        </div>
                        <div class="botonMenuAdmin">
                            <a href="test/area3.php" class="cajaBoton">Área 3</a>
                        </div>
                        <div class="botonMenuAdmin">
                            <a href="tets/area6.php" class="cajaBoton">Área 6</a>
                        </div>
                        <div class="botonMenuAdmin">
                            <a href="test/area8.php" class="cajaBoton">Área 8</a>
                        </div>    
                        <div class="botonMenuAdmin">
                            <a href="test/area9.php" class="cajaBoton">Área 9</a>
                        </div>
                                                                 
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton <?php echo $bgUsuarios?>" type="submit" name="usuarios" value="Usuarios">
                        </div> 
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton <?php echo $bgPassword?>" type="submit" name="password" value="Contraseñas">                           
                        </div>    
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton <?php echo $bgTest?>" type="submit" name="test" value="Test">         
                        </div> 
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton <?php echo $bgResultados?>" type="submit" name="resultados" value="Resultados">           
                        </div> 
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton" disabled type="submit" name="estadisticas" value="Estadísticas">           
                        </div> 
                        <div class="botonMenuAdmin">
                            <input class="cajaBoton" disabled type="submit" name="ayuda" value="Ayuda">           
                        </div> 
                    </div>    
                </form>
            </aside>
            <main class="col-10 col-md-9"> 
                <?php include($seccion)?>
            </main>                           
        </div>         
        
    
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
  </body>
</html>