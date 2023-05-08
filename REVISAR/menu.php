<?php
session_start();
require("pdo.php");

if($_SESSION['autenticado']!="si"){
  echo "<script>location.href='index.php';</script>";
}
$dni=$_SESSION["dni"];
$rol=$_SESSION["rol"];


//consulto a bdd para habilitar los test de comprensión lectora o no
$consulta = $baseDeDatos-> prepare
      ("SELECT areas FROM usuarios WHERE dni = '$dni'");
$consulta->execute();
$consultaTest = $consulta->fetch(PDO::FETCH_ASSOC);

$ocultarAreas="block";
if($consultaTest["areas"] ==-1){
  $ocultarAreas ="none";
}

/* actualizo en base de datos que ya ingreso 
a la actividad al clickear sobre la misma y redirecciono al test seleccionado*/
if(isset($_POST["test1"])){
    $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET test1 = -1 WHERE dni = '$dni'");
        $consulta->execute();
        echo "<script>location.href='empezarTest.php';</script>";
}elseif(isset($_POST["area2"])){
    $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET area2 = -1 WHERE dni = '$dni'");
        $consulta->execute();
        echo "<script>location.href='area2.php';</script>";
}elseif(isset($_POST["area3"])){
    $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET area3 = -1 WHERE dni = '$dni'");
        $consulta->execute();
        echo "<script>location.href='area3.php';</script>";  
}elseif(isset($_POST["area6"])){
    $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET area6 = -1 WHERE dni = '$dni'");
        $consulta->execute();
        echo "<script>location.href='area6.php';</script>";
}elseif(isset($_POST["area8"])){
    $consulta = $baseDeDatos-> prepare
        ("UPDATE usuarios SET area8 = -1 WHERE dni = '$dni'");
        $consulta->execute();
        echo "<script>location.href='area8.php';</script>";
}elseif(isset($_POST["area9"])){
    $consulta = $baseDeDatos-> prepare
      ("UPDATE usuarios SET area9 = -1 WHERE dni = '$dni'");
      $consulta->execute();
      echo "<script>location.href='area9.php';</script>";
}


//desabilito opciones de test si ya los hizo
  $ocultarRaven = "";
  $ocultarArea2 = "";
  $ocultarArea3 = "";
  $ocultarArea6 = "";
  $ocultarArea8 = "";
  $ocultarArea9 = "";  
/*consulto a bdd los niveles test que ya realizó
-2 => aún no ingresó test sin hacer
-1 => ya clickeo en el boton del test y no completó respuestas
>= 0 =>Ingreso al test y presiono el botón terminar.
*/
  $consulta = $baseDeDatos-> prepare
      ("SELECT * FROM usuarios WHERE dni = '$dni'");
  $consulta->execute();
  $consultaTest = $consulta->fetch(PDO::FETCH_ASSOC);

//si ya realizó todos los test, redirecciono a página de fin. 
      if(($consultaTest["test1"]==0) &&
          ($consultaTest["area2"]==0) &&
          ($consultaTest["area3"]==0) &&
          ($consultaTest["area6"]==0) &&
          ($consultaTest["area8"]==0) &&
          ($consultaTest["area9"]==0)){
          
          echo "<script>location.href='endTest.php';</script>";  
            
      } 
      else{
            if($consultaTest["test1"]>=-1){
              $ocultarRaven = "disabled";
            }
            if($consultaTest["area2"]>=-1){
              $ocultarArea2 = "disabled";
            }
            if($consultaTest["area3"]>=-1){
              $ocultarArea3 = "disabled";
            }
            if($consultaTest["area6"]>=-1){
              $ocultarArea6 = "disabled";
            }
            if($consultaTest["area8"]>=-1){
              $ocultarArea8 = "disabled";
            }
            if($consultaTest["area9"]>=-1){
              $ocultarArea9 = "disabled";
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
    <link href="css/menu.css" rel="stylesheet">
    
  </head>
  <body>
      
    <div class="row justify-content-center">
        <main class="col-12 col-md-6 col-xl-4 caja-principal">
            <nav class="row header fwb purple align-items-center">
                <h4 class="col-6">¡Hola <?php echo $_SESSION["name"]?>!</h4>
                <a class="col-6" href="cerrarSesion.php">Cerrar Sesión</a>
            </nav>  
        
        
            <h6 class="fwb centrarTexto">Seleccioná la opción que te indiquen para ingresar a la actividad. ¡Éxitos!</h6>
            <h6 class="centrarTexto">IMPORTANTE: Solo tendrás una oportunidad para hacerlo. Una vez que hagas click
            en el botón, no podrás ingresar nuevamente luego. Recuerda al finalizar, presionar el botón "terminar"</h6>
          
            <form action="menu.php" method= "POST">
                 
                  <!-- boton para raven -->
                  <div class="caja-boton">
                          <input <?php echo $ocultarRaven?> type="submit" class="boton-test" name="test1" value="Test 1">
                  </div>
                  <!-- caja botones para areas-->
                  <div style="display:<?php echo $ocultarAreas;?>">
                      <div class="caja-boton">
                            <input <?php echo $ocultarArea2?> type="submit" class="boton-test" name="area2" value="Área 2">
                      </div>
                      <div class="caja-boton">
                            <input <?php echo $ocultarArea3?> type="submit" class="boton-test" name="area3" value="Área 3">
                      </div>
                      <div class="caja-boton">
                            <input <?php echo $ocultarArea6?> type="submit" class="boton-test" name="area6" value="Área 6">
                      </div>
                      <div class="caja-boton">
                            <input <?php echo $ocultarArea8?> type="submit" class="boton-test" name="area8" value="Área 8">
                      </div>
                      <div class="caja-boton">
                            <input <?php echo $ocultarArea9?> type="submit" class="boton-test" name="area9" value="Área 9">
                      </div>
                      
                  </div> 
            </form>     
        </main>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>