<?php
require("validarLogin.php");
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
    <link href="css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
  </head>
  <body>
    <!--margin-top-index caja-principal-->
      <div class="container">
        <div class="row justify-content-center">
          <main class="cajaPrincipal fwb purple centrarTexto col-10 col-md-6 col-xl-4 ">
            <h3 class="fwb">¡Bienvenido/a!</h3>
            <h5>Para comenzar ingresá tu DNI y <br>la contraseña que te brindamos</h5>
            <form action="index.php" method="POST">
                <label>DNI</label>
                <br>
                <input type="int" autocomplete="off" required name="dni">
                <br>
                <label>Contraseña</label>
                <br>
                <input type="int" autocomplete="off" required name="password">
                <br>
                <div class="error">
                    <?php echo $errorLogin ?>
                    <?php echo $errorUsuario ?>
                </div>    
                <br>
                <div class="comenzar">
                    <input  class="boton-comenzar" type="submit" value="Comenzar">
                </div>    
            </form>
          </main>
        </div>
</div>  
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>