<?php
session_start();
require("../pdo.php");
require("../respuestasCorrectas.php");


$dni=$_SESSION["dni"];
$rol=$_SESSION["rol"];
//si no está logueado redirecciono a loguearse

if($_SESSION['autenticado']!="si"){
    echo "<script>location.href='index.php';</script>";
}


//declaro las variables a utilizar
$error="";
$select1a="";
$select1b="";
$select1c="";
$select1d="";
$select2a="";
$select2b="";
$select2c="";
$select2d="";
$select3a="";
$select3b="";
$select3c="";
$select3d="";
$select4a="";
$select4b="";
$select4c="";
$select4d="";
$select4a="";
$select4b="";
$select4c="";
$select4d="";
$select5a="";
$select5b="";
$select5c="";
$select5d="";
$select6a="";
$select6b="";
$select6c="";
$select6d="";
$select7a="";
$select7b="";
$select7c="";
$select7d="";
$select8a="";
$select8b="";
$select8c="";
$select8d="";
$select9a="";
$select9b="";
$select9c="";
$select9d="";
$select10a="";
$select10b="";
$select10c="";
$select10d="";


if($_POST){
     //valido si no se responden todas las preguntas
    if(!(isset($_POST["1"])) || !(isset($_POST["2"])) || !(isset($_POST["3"]))
    || !(isset($_POST["4"])) || !(isset($_POST["5"])) ||  !(isset($_POST["6"]))
    || !(isset($_POST["7"])) || !(isset($_POST["8"])) || !(isset($_POST["9"]))
    || !(isset($_POST["10"]))  ){

    /*Asigno a la variable el valor checked para que me recuerde la opcion seleccionada*/    
    if(isset($_POST["1"])){
        if($_POST["1"]== "1a"){
              $select1a = "checked";
        }elseif($_POST["1"]== "1b"){
                $select1b = "checked";
        }elseif($_POST["1"]== "1c"){
                $select1c = "checked";
        }else{
                $select1d = "checked";
        }
    }
    if(isset($_POST["2"])){
        if($_POST["2"]=="2a"){
               $select2a = "checked";
        }elseif($_POST["2"]== "2b"){
                $select2b = "checked";
        }elseif($_POST["2"]== "2c"){
                $select2c = "checked";
        }else{
                $select2d = "checked";
        }
    }
    if(isset($_POST["3"])){
        if($_POST["3"]=="3a"){
                $select3a = "checked";
        }elseif($_POST["3"]== "3b"){
                $select3b = "checked";
        }elseif($_POST["3"]== "3c"){
                $select3c = "checked";
        }else{
                $select3d = "checked";
        }
    }
    if(isset($_POST["4"])){
        if($_POST["4"]== "4a"){
                $select4a = "checked";
        }elseif($_POST["4"]== "4b"){
                $select4b = "checked";
        }elseif($_POST["4"]== "4c"){
                $select4c = "checked";
        }else{
                $select4d = "checked";
        }
    }
    if(isset($_POST["5"])){
        if($_POST["5"]== "5a"){
                $select5a = "checked";
        }elseif($_POST["5"]== "5b"){
                $select5b = "checked";
        }elseif($_POST["5"]== "5c"){
                $select5c = "checked";
        }else{
                $select5d = "checked";
        }
    }
    if(isset($_POST["6"])){
        if($_POST["6"]== "6a"){
                $select6a = "checked";
        }elseif($_POST["6"]== "6b"){
                $select6b = "checked";
        }elseif($_POST["6"]== "6c"){
                $select6c = "checked";
        }else{
                $select6d = "checked";
        }
    }
    if(isset($_POST["7"])){
        if($_POST["7"]== "7a"){
                $select7a = "checked";
        }elseif($_POST["7"]== "7b"){
                $select7b = "checked";
        }elseif($_POST["7"]== "7c"){
                $select7c = "checked";
        }else{
                $select7d = "checked";
        }
    }
    if(isset($_POST["8"])){
        if($_POST["8"]== "8a"){
                $select8a = "checked";
        }elseif($_POST["8"]== "8b"){
                $select8b = "checked";
        }elseif($_POST["8"]== "8c"){
                $select8c = "checked";
        }else{
                $select8d = "checked";
        }
    } 
    if(isset($_POST["9"])){
        if($_POST["9"]== "9a"){
                $select9a = "checked";
        }elseif($_POST["9"]== "9b"){
                $select9b = "checked";
        }elseif($_POST["9"]== "9c"){
                $select9c = "checked";
        }else{
                $select9d = "checked";
        }
    }        
    if(isset($_POST["10"])){
        if($_POST["10"]== "10a"){
                $select10a = "checked";
        }elseif($_POST["10"]== "10b"){
                $select10b = "checked";
        }elseif($_POST["10"]== "10c"){
                $select10c = "checked";
        }else{
                $select10d = "checked";
        }
    }        

    $error="Debes responder todas las preguntas";
    }
    //si responde todas las preguntas almaceno los valores y mando a bdd
    else{
        $dni=$_SESSION["dni"];
        $pregunta1 = $_POST["1"];
        $pregunta2 = $_POST["2"];
        $pregunta3 = $_POST["3"];
        $pregunta4 = $_POST["4"];
        $pregunta5 = $_POST["5"];
        $pregunta6 = $_POST["6"];
        $pregunta7 = $_POST["7"];
        $pregunta8 = $_POST["8"];
        $pregunta9 = $_POST["9"];
        $pregunta10 = $_POST["10"];


        //almaceno en bdd las respuestas seleccionadas
        $consulta =  $baseDeDatos -> prepare
            ("UPDATE area8 SET pregunta1 = '$pregunta1', pregunta2='$pregunta2', 
            pregunta3='$pregunta3', pregunta4 ='$pregunta4', pregunta5='$pregunta5', 
            pregunta6='$pregunta6', pregunta7='$pregunta7', pregunta8 ='$pregunta8', 
            pregunta9 = '$pregunta9', pregunta10 = '$pregunta10' WHERE dni = '$dni'");
        $consulta->execute();

        $consulta2 =  $baseDeDatos -> prepare
        ("UPDATE usuarios SET area8=0 WHERE dni = '$dni'");
        $consulta2 -> execute();

        //redirecciono en base al rol del usuario
        if($rol=="postulante"){
            echo "<script>location.href='menu.php';</script>";
        }else{
            echo "<script>location.href='admin.php';</script>";
        }
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Área 8</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/areas.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="row justify-content-center">
        <header class="col-10 col-md-6 col-xl-6 caja-principal">
            <p class="texto-header">
                ÁREA 8: JERARQUÍA DEL TEXTO
                <br>
                Test Leer para Comprender II (TLC-II)
                <br>              
            </p>    
        </header>    
    </div>
    <div class="row justify-content-center">
        <main class="col-10 col-md-6 col-xl-6">
            <h5>Por favor leé atentamente y luego responde las consignas. Esta actividad es sin tiempo.</h5>
            <p>
                <div class="error">
                        <?php echo $error?>
                </div>
                <strong>
                    Leer la siguiente historia
                </strong>  
            </p>    
            <p>
                Una mujer blanca de unos 50 años llegó al asiento que le tocaba 
                en un avión que iba lleno de pasajeros e inmediatamente se negó 
                a sentarse. Le tocaba sentarse al lado de un hombre de raza negra. 
                Disgustada, la mujer inmediatamente llamó a la azafata y le pidió 
                otro asiento. La mujer dijo “yo no puedo sentarme junto a un hombre 
                negro.”
            </p>
            <p>
                La azafata contestó: “Permítame ver su hay otro asiento disponible”. 
                Después de chequear, regresó y le dijo a la mujer: “Señora, no hay otro
                asiento disponible en clase económica, pero revisaré con el capitán para
                verificar si existe algún asiento disponible en primera clase”.
            </p>
            <p>
                Diez minutos después, la azafata regresó y dijo: “El capitán me ha 
                confirmado que no hay asientos disponibles en clase económica pero 
                hay uno en primera clase. No es nuestra costumbre cambiar a una 
                persona de clase económica a primera clase, pero viendo que podría 
                resultar en un escándalo forzar a alguien a sentarse junto a una 
                persona que no le resulte agradable, el capitán estuvo de acuerdo 
                en hacer el cambio”. 
            </p>
            <p>
                Antes de que la mujer pudiera decir algo, la azafata se dirigió al 
                hombre de raza negra y le dijo: “Señor, si fuera usted tan amable de 
                tomar sus artículos personales, queremos moverlo a un asiento más 
                confortable en primera clase ya que el capitán no quiere que usted 
                esté sentado junto a una persona desagradable”.
            </p>
            <p>
                Los pasajeros en los asientos cercanos comenzaron a aplaudir 
                mientras algunos   ovacionaban de pie atinada reacción del 
                capitán y la azafata. 
            </p>
            <form action="area8.php" method="POST">
                <p>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                    </strong>
                </p>
                <p>
                    <strong>
                        1. ¿Cuál es el tema central de esta historia?
                    </strong>
                    <br>
                    <input <?php echo $select1a?> name="1" value="1a" type="radio">  A. El problema de la discriminación.
                    <br>
                    <input <?php echo $select1b?> name="1" value="1b" type="radio">  B. El problema de los asientos incómodos de los aviones.
                    <br>
                    <input <?php echo $select1c?> name="1" value="1c" type="radio">  C. El problema de viajar en clase turista. 
                    <br>
                    <input <?php echo $select1d?> name="1" value="1d" type="radio">   D. El problema de las políticas de las compañías aéreas.
                </p>
                <p>
                    <strong>
                        2. ¿Por qué los pasajeros comenzaron a aplaudir?
                    </strong>
                    <br>
                    <input <?php echo $select2a?> name="2" value="2a" type="radio">   A. Porque festejaban que se hubiera humillado a la mujer racista.
                    <br>
                    <input <?php echo $select2b?> name="2" value="2b" type="radio">  B. Porque festejaban que a uno de los pasajeros lo pasaran a primera clase.
                    <br>
                    <input <?php echo $select2c?> name="2" value="2c" type="radio">  C. Porque festejaban el chiste que hizo la mujer cuando subió.
                    <br>
                    <input <?php echo $select2d?> name="2" value="2d" type="radio">   D. Porque festejaban que finalmente el avión iba a poder despegar.
                </p>
                <p>        
                    <strong>
                        3. ¿Qué título le pondrías a esta historia?
                    </strong>
                    <br>
                    <input <?php echo $select3a?> name="3" value="3a" type="radio">  A. El origen del racismo.
                    <br>
                    <input <?php echo $select3b?> name="3" value="3b" type="radio">  B. Y se hizo justicia.
                    <br>
                    <input <?php echo $select3c?> name="3" value="3c" type="radio">  C. La mujer que quería viajar en primera clase.
                    <br>
                    <input <?php echo $select3d?> name="3" value="3d" type="radio">  D. Crónica de un aterrizaje forzoso.
                </p>
                <p>        
                    <strong>
                        Responder la siguiente pregunta seleccionando la opción correcta.
                        <br>
                        4. ¿En qué te hace pensar el título de un texto llamado “La muerte selectiva”?
                    </strong>
                    <br>
                    <input <?php echo $select4a?> name="4" value="4a" type="radio">  A. En la muerte que afecta a un grupo en particular.
                    <br>
                    <input <?php echo $select4b?> name="4" value="4b" type="radio">  B. En la muerte que afecta a algún órgano en particular.
                    <br>
                    <input <?php echo $select4c?> name="4" value="4c" type="radio">  C. En una muerte intensa y dolorosa.
                    <br>
                    <input <?php echo $select4d?> name="4" value="4d" type="radio">  D. En algo que parece una muerte pero que no lo es.
                </p>
                <br>   
                <p>
                    <strong>
                        Leer el siguiente fragmento de un texto de Marcelo Rodríguez:
                    </strong>
                </p>
                <p>
                    Para el fin del primer milenio, la viruela en Europa se 
                    consideraba una enfermedad que había que “tener de niño para 
                    engrosar la sangre”. Entre un 90 y un 95% de los chicos sobrevivían 
                    a ella y quedaban inmunes de por vida a la variola, que por entonces 
                    mostraba formas relativamente benignas en el Viejo Continente. 
                    O al menos “benignas” frente al cólera, y luego en el siglo XIV frente 
                    a la peste. Recién a finales del siglo XVI la viruela se iba a transformar 
                    en un problema mayor para los europeos, ante la aparición de brotes más 
                    virulentos, como sucedió en 154 en Nápoles o en 1570 en Venecia, donde un 
                    tercio de quienes se contagiaban de viruela morían.
                </p>
                <p>
                    Pero la historia de la muerte selectiva comienza antes. En 1519, 
                    una expedición al mando de Pánfilo de Narváez desembarca en Yucatán 
                    para obligar a regresar a la isla de Santo Domingo a Hernán Cortés, refugiado 
                    en el sur mexicano luego de su derrota a manos del ejército del emperador azteca 
                    Moctezuma. Entre los tripulantes no humanos del barco que venía a rescatar a 
                    Cortés estaba el variola virus, completamente desconocido en América.
                </p>    
                <p>
                    Los americanos no tenían defensas inmunológicas contra la viruela. 
                    Y en apenas un año, la enfermedad mató a más de la mitad de los habitantes 
                    del Imperio Azteca; así, cuando en 1521 Hernán Cortés regresó a Tenochtitlán, 
                    aniquiló a quienes poco más de un año antes lo habían dejado sólo con la décima 
                    parte de su ejército. Aquel 13 de agosto Cortés tomó la capital azteca, aliada 
                    con los toltecas, enemigos acérrimos de Moctezuma, pero también con la ayuda de 
                    ese aliado “no humano” que no podía ser pensado como otra cosa que no fuera un 
                    arma enviada por propio dios.
                </p>    
                <p>
                    En 1531, entre los crímenes de los conquistadores y los virus desconocidos, la 
                    población azteca se redujo veinticinco veces, según calcula Sheldon Watss en 
                    Epidemias y poder. La muerte era selectiva y la raza de los conquistadores gozaba 
                    de inmunidad.
                </p>
                <p>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                        <br>
                        5. De las siguientes frases, ¿cuál es la más importante para comprender el texto?
                    </strong>
                    <br>
                    <input <?php echo $select5a?> name="5" value="5a" type="radio">  A. Los habitantes de América no se encontraban inmunizados contra la viruela y esto ayudó a que Cortés derrotara al imperio azteza.
                    <br>
                    <input <?php echo $select5b?> name="5" value="5b" type="radio">  B. La viruela en Europa se consideraba una enfermedad que había que “tener de niño para engrosar la sangre”.
                    <br>
                    <input <?php echo $select5c?> name="5" value="5c" type="radio">  C. Entre un 90 y un 95% de los europeos que contrarían viruela de pequeños sobre vivían a ella  quedaban inmunizados de por vida.
                    <br>
                    <input <?php echo $select5d?> name="5" value="5d" type="radio">  D. Panfilo de Nárvaez desembarca en América para obligar a Hernán Cortés a regresar a la isla de Santo Domingo.
                </p>
                <p>
                    <strong>
                        6. ¿Qué otro título le pondrías al texto que leíste?
                    </strong>
                    <br>
                    <input <?php echo $select6a?> name="6" value="6a" type="radio">  A. Estadio Azteca.
                    <br>
                    <input <?php echo $select6b?> name="6" value="6b" type="radio">  B. El desembarco de Pánfilo de Narváez.
                    <br>
                    <input <?php echo $select6c?> name="6" value="6c" type="radio">  C. El enemigo no humano de los aztecas.
                    <br>
                    <input <?php echo $select6d?> name="6" value="6d" type="radio">  D. La viruela engrosa la sangre de los niños.
                </p>
                <p>
                    <strong>
                        7. Según el autor, ¿cómo entró el virus en América?
                    </strong>
                    <br>
                    <input <?php echo $select7a?> name="7" value="7a" type="radio">  A. A través de los habitantes del Imperio Azteca.
                    <br>
                    <input <?php echo $select7b?> name="7" value="7b" type="radio">  B. A través de los esclavos africanos que venían en los barcos de los españoles. 
                    <br>
                    <input <?php echo $select7c?> name="7" value="7c" type="radio">  C. A través de la expedición de Hernán Cortés.
                    <br>
                    <input <?php echo $select7d?> name="7" value="7d" type="radio">  D. A través de la expedición de Pánfilo de Nárvaez.
                </p>
                <br>
                <p>
                    <strong>
                        Leer los siguientes problemas y responder las preguntas seleccionando la opción correcta. No es necesario resolver los problemas.
                    </strong>
                </p>
                <p>
                    La última vez que Marcelo vio su primo Gastón fue en 1982 cuando éste tenía 5 años y 
                    Marcelo dos años más. Gastón se fue a vivir a Barcelona tres años después. Marcelo 
                    regresó a Buenos Aires en 2010 ¿Cuántos años tenía cada uno en ese momento?  
                    <br>
                    <strong>
                        8- De las siguientes afirmaciones, ¿cuál contiene información que NO es necesaria para resolver el problema?
                    </strong>    
                    <br>
                    <input <?php echo $select8a?> name="8" value="8a" type="radio">  A. La última vez que Gastón vio a Marcelo fue en 1982.
                    <br>
                    <input <?php echo $select8b?> name="8" value="8b" type="radio">  B. Gastón se fue a vivir a Barcelona tres años después.
                    <br>
                    <input <?php echo $select8c?> name="8" value="8c" type="radio">  C. Marcelo tenía dos años más que Gastón.
                    <br>
                    <input <?php echo $select8d?> name="8" value="8d" type="radio">  D. Marcelo regresó a Buenos Aires en 2010.
                </p>
                <br>
                <p>
                    Un arquitecto está a cargo de la construcción de un edificio de 48 departamentos 
                    en Pedro Goyena al 3000. A los 3 dormitorios del departamento se les debe colocar 
                    el mismo piso cerámico de fabricación nacional. El living mide 3m x 8m, el balcón 
                    1m x 10m, 2 de los dormitorios son iguales y miden 3m x 3,2 m y el dormitorio 
                    principal 4m x 3,5m. Las cerámicas nacionales miden 0.4m x 0,4m. Si las cerámicas 
                    importadas vienen en cajas de 30 unidades y las nacionales en cajas de 20 unidades 
                    ¿cuántas cajas debe comprar?  
                    <br>
                    <strong>
                        9. ¿Cuál de las siguientes informaciones NO se necesita para resolver el problema?
                    </strong>    
                    <br>
                    <input <?php echo $select9a?> name="9" value="9a" type="radio">  A. Las cerámicas miden 0,4m x 0,4m.
                    <br>
                    <input <?php echo $select9b?> name="9" value="9b" type="radio">  B. Las cajas importadas traen 30 unidades.
                    <br>
                    <input  <?php echo $select9c?> name="9" value="9c" type="radio">  C. Dos dormitorios son iguales.
                    <br>
                    <input <?php echo $select9d?> name="9" value="9d" type="radio">   D. Las cajas nacionales traen 20 unidades.
                </p>
                <br>
                <p>
                    <strong>
                        10. ¿Cuál de estos copetes aparecido en el diario Página/12 de febrero de 2013 
                        podría tener el título “El día que cayó piedra sin llover”?
                    </strong>    
                    <br>
                    <input <?php echo $select10a?> name="10" value="10a" type="radio">  A. En Cheliabinsk, en la región de los montes Urales, un meteorito que explotó antes de caer se estrelló en medio de la ciudad. Hubo explosiones estallaron los vidrios y varias paredes resultaron derribadas. Hay algunos heridos de gravedad.
                    <br>
                    <input <?php echo $select10b?> name="10" value="10b" type="radio">  B. La pareja ya estaba en el ojo de la tormenta cuando ella anunció su casamiento. Ayer, aprovechando el día de San Valentín se casaron en Pico Truncado. Él, con permiso de la cárcel. Los esperaban manifestantes que arrojaron huevos a su paso.
                    <br>
                    <input <?php echo $select10c?> name="10" value="10c" type="radio">  C. Según los medios estatales, la prueba fue subterránea con un artefacto “miniaturizado, más liviano y con una mayor fuerza explosiva”, y se llevó a cabo de manera segura y perfecta.
                    <br>
                    <input <?php echo $select10d?> name="10" value="10d" type="radio">  D. Un muerto, cuatro heridos, zonas inundadas y graves daños dejó la violenta tormenta de la semana pasada. En Lugano, una familia fue herida cuando se voló el techo de un Jumbo, y muchos automóviles fueron destrozados. 
                </p>
        
                <p>
                      
                    <div class="enviar">
                        <input class="botonEnviar" type="submit" value="Enviar">
                    </div> 
                </p>               
            </form>
          
        </main>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>