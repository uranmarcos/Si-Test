<?php
session_start();
require("pdo.php");


$rol=$_SESSION["rol"];

if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
    echo "<script>location.href='index.php';</script>";
  }

$errorDniConsulta="";
$errorDniReset="";
$dni = "";
$password="";
$consulta="";
$reset="";

if($_POST){

        if(isset($_POST["consulta"])){
                $dni = $_POST["dniConsulta"];   
        
                $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                $consulta1->execute();
                $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
        
                if(empty($dniExiste)){
                    $errorDniConsulta= "El dni ingresado no está registrado";
                } else{        
                    $password = $dniExiste[0]["password"]; 
                    $consulta="La contraseña para el dni $dni es: $password";
                }
        }
        if(isset($_POST["reset"])){    

                $dni = $_POST["dniReset"];   
                $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                $consulta1->execute();
                $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
                
                if(empty($dniExiste)){
                    $errorDniReset= "El dni ingresado no está registrado";
                } else{    
                    $password = rand(111111, 999999);

                    $consulta2 = $baseDeDatos ->
                        prepare("UPDATE usuarios SET password = '$password' WHERE dni = '$dni'");
                    $consulta2->execute();
                        
                    $reset="Cambio Exitoso. La nueva contraseña para el usuario $dni es $password";
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
    <link href="css/styles2.css" rel="stylesheet">
   
  </head>
  <body class="container">
        <header class="row fwb purple header align-items-center">
                <h4 class="col-6 centrarTexto">¡Hola <?php echo $_SESSION["name"]?>!</h4>
                <a class="col-6 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
        </header>
        <div class="row justify-content-center cajaPrincipal">
                <aside class="col-10 col-md-3">
                    <form class="row justify-content-left" action="admin.php" method="POST">
                                <?php include("aside.php")?>
                    </form>       
                </aside>
                <main class="col-10 col-md-9">
                    <form class="formulario" action="password.php" method="POST">
                        <div>    
                                <h6 class="fwb purple">Consultar Contraseña</h6>
                                <div class="row justify-content-around">        
                                    <label class="col-1 centrarTexto">DNI</label>
                                    <input class="col-10 col-md-3" type="text" name="dniConsulta" autocomplete="off" value="">    
                                    <input class="col-10 col-md-3 botonInput" type="submit" name="consulta" value="Consultar">
                                </div>
                                <p class="red">
                                    <?php echo $errorDniConsulta ?>
                                </p>
                                <p>    
                                    <?php echo $consulta ?>
                                </p>    
                        </div>
                        <br>
                        <div>
                                <h6 class="fwb purple">Cambiar Contraseña</h6>
                                <div class="row justify-content-around">        
                                    <label class="col-1 centrarTexto">DNI</label>
                                    <input class="col-10 col-md-3" type="text" name="dniReset" autocomplete="off" value="">    
                                    <input class="col-10 col-md-3 botonInput" type="submit" name="reset" value="Cambiar"> 
                                </div>
                                <p class="red">
                                    <?php echo $errorDniReset ?>
                                </p>
                                <p>
                                    <?php echo $reset ?>    
                                </p>
                        </div>
                            
                    </form>  
                </main>
        </div>    
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
