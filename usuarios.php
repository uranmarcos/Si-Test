<?php
session_start();
require("validarNuevoUsuario.php");


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
    <link href="css/styles2.css" rel="stylesheet">
    
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
                    <h6 class="fwb purple">Crear un nuevo Usuario</h5>
                    <p>
                        Si al usuario se le asigna rol: "postulante" se le generará una clave aleatoria de 6 dígitos.
                        <br>
                        Si al usuario se le asigna rol: "voluntario" se le generará una clave igual a los últimos 6 dígitos de su DNI. El usuario podrá
                         luego modificar su contraseña ingresando al menú superior derecho.
                    </p>    
                    <form class="formulario" action="usuarios.php" method="POST">
                        <div class="row justify-content-center">        
                                <div class="col-10 col-md-3">    
                                    <label>Nombre</label>
                                    <br>
                                    <input type="text" required name="name" autocomplete="off" value="">    
                                </div>
                                <div class="col-10 col-md-3"> 
                                    <label>Apellido</label>
                                    <br>
                                    <input type="text" required autocomplete="off" name="lastName" value="">
                                </div>
                                <div class="col-10 col-md-3">  
                                    <label>DNI</label>
                                    <br>
                                    <input type="int" required autocomplete="off" name="dni" value="">   
                                </div>   
                                
                                <div class="col-10 col-md-3">
                                    <label>Rol</label>
                                    <br>
                                    <select name="rol">Rol
                                        <option value="postulante">Postulante</option>
                                        <option value="voluntario">Voluntario</option>
                                    </select>           
                                </div>
                        </div>  
                        <br>      
                        <div class="red centrarTexto">
                                <?php echo $errorDni?> 
                        </div> 
                        <p class="centrarTexto"> <?php echo $usuarioCreado; ?></p>
                        
                        <div class="row justify-content-center">
                                <input type="submit" class="botonInput" name="crear" value="crear">
                        </div>
                    </form> 
                  
                </main>                           
                   
        </div>         
        
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
