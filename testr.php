<?php
session_start();
require("pdo.php");
require("respuestasCorrectas.php");

//si no está logueado redirecciono a loguearse
        if($_SESSION['autenticado']!="si"){
            echo "<script>location.href='index.php';</script>";
        }
        
//declaro variables a utilizar
        $dni = $_SESSION["dni"];
        $rol=$_SESSION["rol"];
        $_SESSION["mensaje"]="";

        $ocultarOpciones="none";
        $terminar="none";
        $anularSiguiente="block";
        $selected1="";
        $selected2="";
        $selected3="";
        $selected4="";
        $selected5="";
        $selected6="";
        $selected11="";
        $selected22="";
        $selected33="";
        $selected44="";
        $selected55="";
        $selected66="";
        $selected77="";
        $selected88="";
        $valorNivel="";
        $nivelesInferiores = "block";
        $nivelesSuperiores= "none";
        $mostrarTiempo="";
        $tiempoRestante="";

//consulto a bdd nivel y tiempo del usuario del usuario
        
    $consulta = $baseDeDatos-> prepare
    ("SELECT nivelRaven, tiempoRaven FROM usuarios WHERE dni = '$dni'");
    $consulta->execute();
    $consultaRaven = $consulta->fetch(PDO::FETCH_ASSOC);
    $nivel = $consultaRaven["nivelRaven"];
    $tiempo = $consultaRaven["tiempoRaven"];
    if(empty($consultaRaven["tiempoRaven"])){
    $tiempo = 2700;
    }else{
    $tiempo = $tiempo;
    }





//paso numero de nivel de int a string para poder conectar a columnas bdd
        if($nivel == 1){
            $valorNivel="uno";
        } elseif($nivel == 2){
            $valorNivel="dos";
        } elseif($nivel == 3){
            $valorNivel="tres";
        } elseif($nivel == 4){
            $valorNivel="cuatro";
        } elseif($nivel == 5){
            $valorNivel="cinco";
        } elseif($nivel == 6){
            $valorNivel="seis";
        } elseif($nivel == 7){
            $valorNivel="siete";
        } elseif($nivel == 8){
            $valorNivel="ocho";
        } elseif($nivel == 9){
            $valorNivel="nueve";
        } elseif($nivel == 10){
            $valorNivel="diez";
        }elseif($nivel == 11){
        $valorNivel="once";
        } elseif($nivel == 12){
        $valorNivel="doce";
        } elseif($nivel == 13){
        $valorNivel="trece";
        } elseif($nivel == 14){
        $valorNivel="catorce";
        } elseif($nivel == 15){
        $valorNivel="quince";
        } elseif($nivel == 16){
        $valorNivel="dieciseis";
        } elseif($nivel == 17){
        $valorNivel="diecisiete";
        } elseif($nivel == 18){
        $valorNivel="dieciocho";
        } elseif($nivel == 19){
        $valorNivel="diecinueve";
        }elseif($nivel == 20){
        $valorNivel="veinte";
        } elseif($nivel == 21){
        $valorNivel="veintiuno";
        } elseif($nivel == 22){
        $valorNivel="veintidos";
        } elseif($nivel == 23){
        $valorNivel="veintitres";
        } elseif($nivel == 24){
        $valorNivel="veinticuatro";
        } elseif($nivel == 25){
        $valorNivel="veinticinco";
        } elseif($nivel == 26){
        $valorNivel="veintiseis";
        } elseif($nivel == 27){
        $valorNivel="veintisiete";
        } elseif($nivel == 28){
        $valorNivel="veintiocho";
        } elseif($nivel == 29){
        $valorNivel="veintinueve";
        } elseif($nivel == 30){
        $valorNivel="treinta";
        } elseif($nivel == 31){
        $valorNivel="treintayuno";
        } elseif($nivel == 32){
        $valorNivel="treintaydos";
        } elseif($nivel == 33){
        $valorNivel="treintaytres";
        } elseif($nivel == 34){
        $valorNivel="treintaycuatro";
        } elseif($nivel == 35){
        $valorNivel="treintaycinco";
        } elseif($nivel == 36){
        $valorNivel="treintayseis";
        } elseif($nivel == 37){
        $valorNivel="treintaysiete";
        } elseif($nivel == 38){
        $valorNivel="treintayocho";
        } elseif($nivel == 39){
        $valorNivel="treintaynueve";
        } elseif($nivel == 40){
        $valorNivel="cuarenta";
        } elseif($nivel == 41){
        $valorNivel="cuarentayuno";
        } elseif($nivel == 42){
        $valorNivel="cuarentaydos";
        } elseif($nivel == 43){
        $valorNivel="cuarentaytres";
        } elseif($nivel == 44){
        $valorNivel="cuarentaycuatro";
        } elseif($nivel == 45){
        $valorNivel="cuarentaycinco";
        } elseif($nivel == 46){
        $valorNivel="cuarentayseis";
        } elseif($nivel == 47){
        $valorNivel="cuarentaysiete";
        } elseif($nivel == 48){
        $valorNivel="cuarentayocho";
        } elseif($nivel == 49){
        $valorNivel="cuarentaynueve";
        } elseif($nivel == 50){
        $valorNivel="cincuenta";
        } elseif($nivel == 51){
        $valorNivel="cincuentayuno";
        } elseif($nivel == 52){
        $valorNivel="cincuentaydos";
        } elseif($nivel == 53){
        $valorNivel="cincuentaytres";
        } elseif($nivel == 54){
        $valorNivel="cincuentaycuatro";
        } elseif($nivel == 55){
        $valorNivel="cincuentaycinco";
        } elseif($nivel == 56){
        $valorNivel="cincuentayseis";
        } elseif($nivel == 57){
        $valorNivel="cincuentaysiete";
        } elseif($nivel == 58){
        $valorNivel="cincuentayocho";
        } elseif($nivel == 59){
        $valorNivel="cincuentaynueve";
        } elseif($nivel == 60){
        $valorNivel="sesenta";
        }


//consulto si tiene respuesta guardada en el nivel
        $consultaRecordar = $baseDeDatos-> prepare  ("SELECT $valorNivel from test1 WHERE dni = $dni");
        $consultaRecordar->execute();
        $datosGuardados =$consultaRecordar -> fetchAll(PDO::FETCH_ASSOC);

            if($nivel<25){
                    if      ($datosGuardados[0][$valorNivel]==1){
                                $selected1 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==2){
                                $selected2 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==3){
                                $selected3 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==4){
                                $selected4 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==5){
                                $selected5 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==6){
                                $selected6 = "checked";        
                }
            }    
            if($nivel>24){
                    if      ($datosGuardados[0][$valorNivel]==1){
                                $selected11 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==2){
                                $selected22 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==3){
                                $selected33 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==4){
                                $selected44 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==5){
                                $selected55 = "checked";
                    }elseif ($datosGuardados[0][$valorNivel]==6){
                                $selected66 = "checked";        
                    }elseif ($datosGuardados[0][$valorNivel]==7){
                                $selected77 = "checked";        
                    }elseif ($datosGuardados[0][$valorNivel]==8){
                                $selected88 = "checked";        
                    }
                }
            



//acciones en base al boton que selecciona por nivel
    if($_POST){
        if(($_POST["cambiarNivel"]) == "siguiente"){
                if(isset($_POST[$nivel])){           
                        $valor=$_POST[$nivel];
                        $consulta = $baseDeDatos-> prepare
                            ("UPDATE test1 SET $valorNivel = '$valor' WHERE dni = '$dni'");
                        $consulta->execute();
                }       
                        $mostrarTiempo = $_POST["mostrarTiempo"];
                        $matriz=explode(":",$mostrarTiempo); 
                        $tiempoRestante=($matriz[0]*60)+$matriz[1]; 
                        
                        $nivel++;
                        if($tiempoRestante!=null){
                        $consulta2 = $baseDeDatos-> prepare
                            ("UPDATE usuarios SET nivelRaven = '$nivel', tiempoRaven='$tiempoRestante' WHERE dni = '$dni'");
                        $consulta2->execute();
                        }
                        echo "<script>location.href='testr.php';</script>";
               
        }elseif(($_POST["cambiarNivel"]) == "anterior"){
                if(isset($_POST[$nivel])) {
                        $valor=$_POST[$nivel];
                        $consulta = $baseDeDatos-> prepare
                            ("UPDATE test1 SET $valorNivel = '$valor' WHERE dni = '$dni'");
                        $consulta->execute();
                }       
                        $mostrarTiempo = $_POST["mostrarTiempo"];
                        $matriz=explode(":",$mostrarTiempo); 
                        $tiempoRestante=($matriz[0]*60)+$matriz[1]; 

                        $nivel--;
                        if($nivel==0){
                            $nivel=1;
                        }
                        if($tiempoRestante!=null){
                        $consulta2 = $baseDeDatos-> prepare
                            ("UPDATE usuarios   SET nivelRaven = '$nivel', tiempoRaven='$tiempoRestante' WHERE dni = '$dni'");
                        $consulta2->execute();
                        }
                        echo "<script>location.href='testr.php';</script>";
               
        }elseif(($_POST["cambiarNivel"]) == "terminar"){
                if(isset($_POST[$nivel])) {
                        $valor=$_POST[$nivel];
                        $consulta = $baseDeDatos-> prepare
                            ("UPDATE test1 SET $valorNivel = '$valor' WHERE dni = '$dni'");
                        $consulta->execute();
                }        
                        
                $consulta2 = $baseDeDatos-> prepare
                            ("UPDATE usuarios SET areas = -2, test1=0 WHERE dni = '$dni'");
                $consulta2->execute();
                echo "<script>location.href='menu.php';</script>";
        }
    }        





//a partir del nivel 24 habilito opciones respuesta 7 y 8    
        if($nivel>24){
            $nivelesInferiores = "none";
            $nivelesSuperiores= "block";
        }
// variables para anular/visibilizar botones en último nivel
        if($nivel==60){
            $terminar="block";
            $anularSiguiente="none";
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
    <link href="css/raven2.css" rel="stylesheet">
   
  </head>
  <!--asigno a js el valor disponible para el usuario en bdd -->
    <script type="text/javascript">
                var seg = <?php echo $tiempo?> 
    </script>  
  <body class="row justify-content-center">
        <main class="main col-md-4">
                <div class="header" style="height:40px; line-height:40px;">
                        <div class="row justify-content-center">
                                <!-- si saco esta caja no se visualiza el cronometro --> 
                                <div class="container col-3"  
                                    style="background-color:purple;
                                            height:20px; 
                                            font-size: 5px; 
                                            color:purple;">
                                </div>
                                <div class= "col-4" style="font-size:20px; line-height:40px; text-align:center;">
                                     <?php echo "Nivel : " . $nivel?>
                                </div>
                        </div>        
                </div> 
               
                <form class="row justify-content-center caja-externa" action="testr.php" method="POST">
                    <div style="background-image:url('img/imagen<?php echo $nivel?>.jpg')" class="col-12 cajaNivel ">
                        <div style="display:<?php echo $nivelesInferiores?>">
                                <div class="row opciones-superior">   
                                            <div class="col-4 opcion">    
                                                <input <?php echo $selected1?> name="<?php echo $nivel?>" value="1" type="radio">
                                            </div>   
                                            <div class="col-4 opcion">
                                                <input <?php echo $selected2?> name="<?php echo $nivel?>" value="2" type="radio">
                                            </div>
                                            <div class="col-4 opcion">
                                                <input <?php echo $selected3?> name="<?php echo $nivel?>" value="3" type="radio">
                                            </div>
                                </div>  
                                <div class="row opciones-inferior">              
                                            <div class="col-4 opcion">
                                                <input <?php echo $selected4?> name="<?php echo $nivel?>" value="4" type="radio">
                                            </div>
                                            <div class="col-4 opcion">
                                                <input <?php echo $selected5?> name="<?php echo $nivel?>" value="5" type="radio">
                                            </div>
                                            <div class="col-4 opcion">
                                                <input <?php echo $selected6?> name="<?php echo $nivel?>" value="6" type="radio">
                                            </div>
                                </div>  
                        </div>     
    
                        <div style="display:<?php echo $nivelesSuperiores?>">
                                <div class="row opciones-superior">   
                                            <div class="col-3 opcion">    
                                                <input <?php echo $selected11?> name="<?php echo $nivel?>" value="1" type="radio">
                                            </div>   
                                            <div class="col-3 opcion">
                                                <input <?php echo $selected22?> name="<?php echo $nivel?>" value="2" type="radio">
                                            </div>
                                            <div class="col-3 opcion">
                                                <input <?php echo $selected33?> name="<?php echo $nivel?>" value="3" type="radio">
                                            </div>
                                            <div class="col-3 opcion">
                                                <input <?php echo $selected44?> name="<?php echo $nivel?>" value="4" type="radio">
                                            </div>
                                </div>  
                                <div class="row opciones-inferior">              
                                            <div class="col-3 opcion">
                                                <input <?php echo $selected55?> name="<?php echo $nivel?>" value="5" type="radio">
                                            </div>
                                            <div class="col-3 opcion">
                                                <input <?php echo $selected66?> name="<?php echo $nivel?>" value="6" type="radio">
                                            </div>
                                            <div class="col-3 opcion">
                                                <input  <?php echo $selected77?> name="<?php echo $nivel?>" value="7" type="radio">
                                            </div>
                                            <div class="col-3 opcion">
                                                <input  <?php echo $selected88?> name="<?php echo $nivel?>" value="8" type="radio">
                                            </div>
                                </div>  
                        </div> 
             
                    </div> 
                    <div class="row menu justify-content-around">    
                            <input class="col-2" type="submit"  name="cambiarNivel" value="anterior">
                            <div class="col-4" style="position:relative;">
                                <input  type="text"    name="mostrarTiempo"  id="mostrarTiempo" style="width:100%;height:100%; z-index:1; text-align:center; font-size:20px; position:absolute;">
                                <div style="position:absolute; width:100%; height:100%; border: solid 2px black; z-index:2; opacity:1;">
                                </div>
                            </div>    
                                <input class="col-2" type="submit"  name="cambiarNivel" value="terminar" style="display:<?php echo $terminar?>">
                            <input class="col-2" type="submit"  name="cambiarNivel" value="siguiente" id="siguiente" style="display:<?php echo $anularSiguiente?>">            
                    </div>        
                </form> 

                <script>
                    var container = document.querySelector(".container");
                   // var start = document.querySelector(".start");
                    var siguiente = document.getElementById("siguiente");
                    var anterior = document.getElementById("anterior");
                    var tiempoRaven = document.getElementById("mostrarTiempo");
                    
                   
                    //temporizador y finalizacion de test al culminar el tiempo.
                    document.addEventListener("DOMContentLoaded",function(event){
                        setInterval(function(){
                            container.innerText = seg;
                            function secondsToString(seg) {
                                var minute = Math.floor((seg / 60) % 60);
                                minute = (minute < 10)? '0' + minute : minute;
                                var second = seg % 60;
                                second = (second < 10)? '0' + second : second;
                                return  minute + ':' + second;
                            }
                       
                            var terminar = secondsToString(seg);
                            tiempoRaven.value= terminar;
                            seg--;

                            var endTest = seg==0;
                            if(endTest== true){
                                  
                                   location.href='endTime.php';
                                    // header("Location: endTime.php");
                                   // die();  
                            }
                        }
                        ,1000)
                    })
                    
                    
                  
                    siguiente.onclick = function(){
                        clearInterval(contador);
                    }
                    anterior.onclick = function(){
                        clearInterval(contador);
                    }



                </script>             
            
          </main>
    </div>

    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    

  </body>
</html>