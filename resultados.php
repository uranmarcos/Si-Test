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
$correctasTest1="s/d";
$totalAreas="s/d";
$mostrarConsulta="none";

  

if($_POST){
    if(isset($_POST["consultarDni"])){
            $dni = $_POST["dni"];
            if((is_numeric($dni))!=true){
                $errorDni = "El valor ingresado debe ser numérico";
            }else{
                //verifico que el dni este registrado como usuario
                $consultaDni = $baseDeDatos-> prepare  ("SELECT * from usuarios WHERE dni =$dni");
                $consultaDni->execute();
                $datosDni =$consultaDni -> fetchAll(PDO::FETCH_ASSOC);
                
                //si el dni ingresado no esta en bdd asigno error
                if(empty($datosDni)){
                    $errorDni ="El dni ingresado no está registrado como usuario";
                }
                //si el dni ingresado esta en bdd brindo los resultados
                else{
                    $mostrarConsulta="block";
                    $nombre=$datosDni[0]["nombre"];
                    $apellido = $datosDni[0]["apellido"];
                    $dni2=$datosDni[0]["dni"];
                    $hizoTest1=$datosDni[0]["test1"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    $hizoArea2=$datosDni[0]["area2"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    $hizoArea3=$datosDni[0]["area3"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    $hizoArea6=$datosDni[0]["area6"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    $hizoArea8=$datosDni[0]["area8"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    $hizoArea9=$datosDni[0]["area9"];   //(-2 no lo hizo, -1 entro y no termino, 0 termino el test)
                    
                    //si no termino raven asigno valor sin datos, si lo termino calculo resultados
                    if($hizoTest1 == -2){
                            $correctasTest1="s/d";
                    }elseif($hizoTest1 == -1){
                            $correctasTest1 = "s/t";
                    }else{
                            //consulto resultados raven y calculo cantidad de respuestas correctas                     
                            $consultaTest1 = $baseDeDatos-> prepare  ("SELECT uno, dos, tres, cuatro, cinco, seis, 
                                    siete, ocho, nueve, diez, once, doce, trece, catorce, quince, dieciseis, diecisiete, dieciocho,
                                    diecinueve, veinte, veintiuno, veintidos, veintitres, veinticuatro, veinticinco, veintiseis,
                                    veintisiete, veintiocho, veintinueve, treinta, treintayuno, treintaydos, treintaytres, treintaycuatro,
                                    treintaycinco, treintayseis, treintaysiete, treintayocho, treintaynueve, cuarenta, cuarentayuno, cuarentaydos,
                                    cuarentaytres, cuarentaycuatro, cuarentaycinco, cuarentayseis, cuarentaysiete, cuarentayocho, cuarentaynueve, cincuenta,
                                    cincuentayuno, cincuentaydos, cincuentaytres, cincuentaycuatro, cincuentaycinco, cincuentayseis, cincuentaysiete,
                                    cincuentayocho, cincuentaynueve, sesenta
                                    from test1 WHERE dni = $dni");
                            $consultaTest1->execute();
                            $datosTest1 =$consultaTest1 -> fetchAll(PDO::FETCH_ASSOC);
                            
                            $comparacionTest1 = array_intersect_assoc($test1, $datosTest1[0]);
                            $correctasTest1 = count($comparacionTest1);
                    }

                    //si no termino alguna de las areas asigno sin datos, si termino todas las raeas calculo resultados    
                    if(($hizoArea2 ==-2 )&&($hizoArea3 ==-2)||($hizoArea6==-2)||($hizoArea8==-2)||($hizoArea9==-2)){
                            $totalAreas = "s/d";
                    }elseif(($hizoArea2 ==-1 )||($hizoArea3 ==-1)||($hizoArea6==-1)||($hizoArea8==-1)||($hizoArea9==-1)){
                        $totalAreas = "s/t";
                    }else{
                            
                            //calculo la cantidad de respuestas correctas area2
                            $consultaArea2 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                                pregunta4, pregunta5, pregunta6, pregunta7, pregunta8 from area2 WHERE dni = $dni");
                            $consultaArea2->execute();
                            $datosArea2 =$consultaArea2 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea2 = array_intersect_assoc($area2, $datosArea2[0]);
                            $correctasArea2 = count($comparacionArea2);

                            //calculo cantidad de respuestas correctas area3
                            $consultaArea3 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area3 WHERE dni = $dni");
                            $consultaArea3->execute();
                            $datosArea3 =$consultaArea3 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea3 = array_intersect_assoc($area3, $datosArea3[0]);
                            $correctasArea3 = count($comparacionArea3);

                            //calculo cantidad de respuestas correctas area6
                            $consultaArea6 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area6 WHERE dni = $dni");
                            $consultaArea6->execute();
                            $datosArea6 =$consultaArea6 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea6 = array_intersect_assoc($area6, $datosArea6[0]);
                            $correctasArea6 = count($comparacionArea6);
                            
                            //calculo cantidad de respuestas correctas area8
                            $consultaArea8 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area8 WHERE dni = $dni");
                            $consultaArea8->execute();
                            $datosArea8 =$consultaArea8 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea8 = array_intersect_assoc($area8, $datosArea8[0]);
                            $correctasArea8 = count($comparacionArea8);
                            

                            //calculo cantidad de respuestas correctas area9
                            $consultaArea9 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area9 WHERE dni = $dni");
                            $consultaArea9->execute();
                            $datosArea9 =$consultaArea9 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea9 = array_intersect_assoc($area9, $datosArea9[0]);
                            $correctasArea9 = count($comparacionArea9);
                            
                            $totalAreas = ($correctasArea2 + $correctasArea3 + $correctasArea6 + $correctasArea8 
                            + $correctasArea9)/4.8;
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
                    <h6 class="fwb purple">Consultar Resultados</h6>
                    <br>
                    <form class="formulario" action="resultados.php" method="POST">
                        <div class="row justify-content-around">  
                                DNI  
                                <input class="col-5" type="integer" autocomplete="off" name="dni" value="">   
                                <input class="col-3 botonInput" type="submit" name="consultarDni" value="Consultar"> 
                            </div> 
                            <br>
                            <br>    
                              
                            <div class="red"> 
                                    <?php echo $errorDni?> 
                            </div>    
                                             
                    </form> 
                    <div style="display:<?php echo $mostrarConsulta?>">
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
                            <br>  
                            <p style="font-size:11px" class="red">
                                <strong>s/d:</strong> El usuario aún no ingresó al test.
                                <br>
                                Test Liberado. 
                                <br>
                                <br>                                
                                <strong>s/t:</strong> El usuario ingresó al test y salió del mismo sin terminarlo. 
                                    En Raven se habrán guardado las respuestas que haya seleccionado antes de salir, en CT no.
                                    <br>Test Bloqueado.
                                                              
                            </p>                         
                    </div>
                    
                    
        </main>
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>