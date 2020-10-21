<?php
session_start();
require("pdo.php");

$rol=$_SESSION["rol"];

if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
    echo "<script>location.href='index.php';</script>";
  }

$testHabilitado="";
$errorDniBloquear="";
$errorDniHabilitar="";
$errorDniAvance="";
$bloqueo="";
$dni = 0;
$ocultar = "block";
$mostrar="none";
$mostrarAvance="none";
$errorTestHabilitar="";
$errorTestBloquear ="";
$tiempoDisponible=0;

if($_POST){
        if(isset($_POST["habilitar"])){
                if($_POST["testHabilitar"]=="none"){
                    $errorTestHabilitar = "Debe seleccionar el test que desea habilitar";
                }else{
                    if(empty($_POST["dniHabilitar"])){
                            $errorDniHabilitar="Debe ingresar un DNI";
                    }else{
                            $dni = $_POST["dniHabilitar"];   

                            $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                            $consulta1->execute();
                            $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);

                            if(empty($dniExiste)){
                                $errorDniHabilitar= "El dni ingresado no está registrado";
                            }else{
                                $testAHabilitar = $_POST["testHabilitar"];

                                if($testAHabilitar=="test1"){
                                    if(empty($_POST["tiempo"])){
                                        $tiempoDisponible=2700;
                                    } else{
                                        $tiempoDisponible=$_POST["tiempo"]*60;
                                    }
                                    $consulta = $baseDeDatos-> prepare
                                        ("UPDATE usuarios SET $testAHabilitar = -2, nivelRaven=1, horaRaven='s/d',
                                        tiempoRaven =$tiempoDisponible WHERE dni = '$dni'");
                                    $consulta->execute();
                                    $testHabilitado="Se habilitó '$testAHabilitar' exitosamente para el usuario '$dni'";

                                }else{
                                    $consulta = $baseDeDatos-> prepare
                                        ("UPDATE usuarios SET $testAHabilitar = -2 WHERE dni = '$dni'");
                                    $consulta->execute();
                                    $testHabilitado="Se habilitó '$testAHabilitar' exitosamente para el usuario '$dni'";
                                } 
                            }    
                    }        
            }    
        }         
        if(isset($_POST["bloquear"])){
                if($_POST["testBloquear"]=="none"){
                    $errorTestBloquear = "Debe seleccionar el test que desea bloquear";
                }else{
                    if(empty($_POST["dniBloquear"])){
                            $errorDniBloquear="Debe ingresar un DNI";
                    }else{
                            $dni = $_POST["dniBloquear"];   

                            $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                            $consulta1->execute();
                            $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);

                            if(empty($dniExiste)){
                                $errorDniBloquear= "El dni ingresado no está registrado";
                            }else{
                                $testABloquear = $_POST["testBloquear"];
                                $consulta2 = $baseDeDatos ->
                                        prepare("UPDATE usuarios SET $testABloquear = -1 WHERE dni = '$dni'");
                                $consulta2->execute();
                                $bloqueo="Se ha bloqueado exitosamente $testABloquear para el usuario $dni";
                            } 
                    }        
                }        
        }
        if(isset($_POST["avance"])){
                if(empty($_POST["dniAvance"])){
                       $errorDniAvance="Debe ingresar un DNI";
                }else{

                        $dni = $_POST["dniAvance"]; 
                        $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                        $consulta1->execute();
                        $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
                        
                        
                        if(empty($dniExiste)){
                            $errorDniAvance= "El dni ingresado no está registrado";
                        }else{
                            $mostrarAvance ="block";
                            $raven =$dniExiste[0]["test1"];
                                if($raven == -2 ){
                                    $avanceRaven = "No";
                                }elseif($raven==-1){
                                    $avanceRaven="Bl";
                                }else{
                                    $avanceRaven = "Sí";
                                }
                            if(empty($dniExiste[0]["horaRaven"])){
                                $horaInicio = "s/d";
                            }else{
                                $horaInicio = $dniExiste[0]["horaRaven"];
                            }
                                                       
                            $area2 =$dniExiste[0]["area2"];
                                if($area2 == -2){
                                    $avanceArea2 = "No";
                                }elseif($area2 == -1){
                                    $avanceArea2 = "Bl";
                                }
                                else{
                                    $avanceArea2="Sí";
                                }
                            $area3 =$dniExiste[0]["area3"];
                                if($area3 == -2){
                                    $avanceArea3 = "No";
                                }elseif($area3 == -1){
                                    $avanceArea3 = "Bl";
                                }else{
                                    $avanceArea3="Sí";
                                } 
                            $area6 =$dniExiste[0]["area6"];
                                if($area6 == -2){
                                    $avanceArea6 = "No";
                                }elseif($area6 == -1){
                                    $avanceArea6 = "Bl";
                                }else{
                                    $avanceArea6="Sí";
                                }      
                            $area8 =$dniExiste[0]["area8"];
                                if($area8 == -2){
                                    $avanceArea8 = "No";
                                }elseif($area8 == -1){
                                    $avanceArea8 = "Bl";
                                }else{    
                                    $avanceArea8="Sí";
                                }   
                            $area9 =$dniExiste[0]["area9"];
                                if($area9== -2){
                                    $avanceArea9 = "No";
                                }elseif($area9 == -1){
                                    $avanceArea9 = "Bl";
                                }else{    
                                    $avanceArea9="Sí";
                                }      
                        }
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
                       <?php include("aside.php")?>     
                </aside>
            <main class="col-10 col-md-9">
                                    
                    <form class="formulario" action="test.php" method="POST">
                        <div>
                            <h6 class="fwb purple">Habilitar Test</h6>
                            <div>
                                <p>Al hacerlo, se borrarán los resultados que el usuario haya obtenido en el mismo. <br> 
                                Si habilita Raven, en la columna siguiente puede ingresar los minutos que desea habilitarle al usuario. En caso de no ingresar ningún valor
                                se le darán 45 minutos.</p>                        
                                <div class="row justify-content-between" >    
                                        <label class="col-1">DNI</label> 
                                        <input class="col-2" type="text" name="dniHabilitar" autocomplete="off" value=""> 
                                        <select class="col-2" name="testHabilitar">Test
                                                    <option value="none"></option>
                                                    <option value="test1">Raven</option>
                                                    <option value="areas">Áreas</option>
                                                    <option value="area2">Área 2</option>
                                                    <option value="area3">Área 3</option>
                                                    <option value="area6">Área 6</option>
                                                    <option value="area8">Área 8</option>
                                                    <option value="area9">Área 9</option>
                                        </select> 
                                        <input class="col-2" type="number" name="tiempo" autocomplete="off" value="minutos Raven">  
                                        <input class="col-3 botonInput" type="submit" name="habilitar" value="Habilitar">
                                </div>
                            </div>    
                            <p class="red">
                                    <?php echo $errorDniHabilitar ?>
                                    <?php echo $errorTestHabilitar?>
                            </p>
                            <p>
                                    <?php echo $testHabilitado ?>
                            </p>  
                                
                        </div>            
                        <br>
                        <!-- Bloquear Test -->
                        <div>
                            <h6 class="fwb purple">Bloquear Test</h6>
                            <div>
                                    <p>Al hacerlo, se le inhabilitará el botón del mismo al usuario seleccionado.</p>                          
                                    <div class="row justify-content-between">        
                                            <label class="col-2 centrarTexto">DNI:</label>
                                            <input class="col-3" type="text"  name="dniBloquear" autocomplete="off" value="">    
                                            <select class="col-3" name="testBloquear">Test
                                                        <option value="none"></option>
                                                        <option value="test1">Raven</option>
                                                        <option value="areas">Áreas</option>
                                                        <option value="area2">Área 2</option>
                                                        <option value="area3">Área 3</option>
                                                        <option value="area6">Área 6</option>
                                                        <option value="area8">Área 8</option>
                                                        <option value="area9">Área 9</option>
                                            </select> 
                                            <input class="col-3 botonInput" type="submit" name="bloquear" value="Bloquear">
                                    </div>
                            </div>    
                            <p class="centrarTexto mensajeError">
                                    <?php echo $errorDniBloquear ?>
                                    <?php echo $errorTestBloquear ?>
                            </p>
                            <p>
                                    <?php echo $bloqueo ?>
                            </p>  
                                
                        </div> 
                        
                        <div>
                            <h6 class="fwb purple">Consultar avance por usuario</h6>
                            <div>
                                    <div class="row justify-content-between">        
                                            <label class="col-2 centrarTexto">DNI:</label>
                                            <input class="col-3" type="text"  name="dniAvance" autocomplete="off" value="">
                                            <div class="col-3"> </div>    
                                            <input class="col-3 botonInput" type="submit" name="avance" value="Consultar">
                                    </div>  
                                    <p class="centrarTexto mensajeError">
                                            <?php echo $errorDniAvance ?>
                                    </p> 
                                    <br>
                                    <div style="display:<?php echo $mostrarAvance?>;"> 
                                            <div class="row centrarTexto justify-content-between">
                                                    <div class="col-2">DNI</div>
                                                    <div class="col-1"></div>
                                                    <div class="col-3">Inicio R</div>
                                                    <div class="col-1">R</div>
                                                    <div class="col-1">A2</div>
                                                    <div class="col-1">A3</div>
                                                    <div class="col-1">A6</div>
                                                    <div class="col-1">A8</div>
                                                    <div class="col-1">A9</div>
                                            </div>  
                                            <div class="row centrarTexto justify-content-between">
                                                    <div class="col-2"><?php echo $dni?></div>
                                                    <div class="col-1"></div>
                                                    <div class="col-3"><?php echo $horaInicio?></div>
                                                    <div class="col-1"><?php echo $avanceRaven?></div>
                                                    <div class="col-1"><?php echo $avanceArea2?></div>
                                                    <div class="col-1"><?php echo $avanceArea3?></div>
                                                    <div class="col-1"><?php echo $avanceArea6?></div>
                                                    <div class="col-1"><?php echo $avanceArea8?></div>
                                                    <div class="col-1"><?php echo $avanceArea9?></div>
                                            </div>
                                            <br>
                                            <p style="font-size:11px" class="red">
                                                <strong>Sí:</strong> El usuario ingresó y terminó el test (o se cumplió el tiempo en Raven).
                                                Test Bloqueado.
                                                <br>
                                                <strong>Bl:</strong> El usuario ingresó al test y salió del mismo sin presionar terminar.
                                                En Raven se habrán guardado las respuestas que haya seleccionado antes de salir, en CT no.
                                                Test Bloqueado.
                                                <br>
                                                <strong>No:</strong> El usuario aún no ingresó al test. Lo tiene liberado.
                                                <br>
                                                <strong>Inicio R: </strong>Muestra el horario en que el usuario comenzó el test Raven.
                                            </p>
                                    </div>
                            </div>        
                            <br>        
                        </div>    
                         
                    </form>  
                   
                    
            </main>
        </div>    
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
