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


//si está loguedo y no realizó el test aún:
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
            ("UPDATE area6 SET pregunta1 = '$pregunta1', pregunta2='$pregunta2', 
            pregunta3='$pregunta3', pregunta4 ='$pregunta4', pregunta5='$pregunta5', 
            pregunta6='$pregunta6', pregunta7='$pregunta7', pregunta8 ='$pregunta8', 
            pregunta9 = '$pregunta9', pregunta10 = '$pregunta10' WHERE dni = '$dni'");
        $consulta->execute();

        $consulta2 =  $baseDeDatos -> prepare
        ("UPDATE usuarios SET area6=0 WHERE dni = '$dni'");
        $consulta2 -> execute();

        //redirecciono en base al rol del usuarioz
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
    <title>Área 6</title>
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
                ÁREA 6: INFERENCIAS
                <br>
                Test Leer para Comprender II (TLC-II)
            </p>    
        </header>    
    </div>
    <div class="row justify-content-center">
      <main class="col-10 col-md-6 col-xl-6 ">
            <h5>Por favor leé atentamente y luego responde las consignas. Esta actividad es sin tiempo.</h5>
            <p>
                <div class="error">
                        <?php echo $error?>
                </div>
                <strong>
                    Leer la siguiente noticia. Las palabras en mayúsculas no existen.
                </strong>  
            </p>
            <h1>Mensaje de texto sin mirar el celular</h1>    
            <p>
                <em>Expertos de Georgia presentarán una tecnología de fácil uso para aparatos de telefonía móvil,
                basada en el sistema de escritura Braille, utilizado por los ciegos.</em>
            </p>
            <p>
                Una nueva aplicación para enviar y recibir mensajes con dispositivos móviles de pantalla táctil
                podría ser TAMIGADA tanto por personas no videntes como también por individuos sin problemas
                de visión que quieran escribir textos sin necesidad de mirar la pantalla.
            </p>
            <p>
                La moderna herramienta, diseñada e instrumentada por el Instituto de Tecnología de Gerogia,
                estará disponible en las próximas semanas. Se espera que con ella, los invidentes sean capaces de
                escribir textos seis veces más rápido que con los actuales métodos que existen a su disposición.
                Los expertos HOFIDIERON que instrumentos actualmente utilizados por individuos que padecen
                ceguera, como la tecnología de voz, son funcionales pero demasiado lentos para se efectivos. Los
                mensajes convertidos en audio muchas veces no se entienden, y además preservan poco la
                intimidad.
            </p>    

            <form action="area6.php" method="POST">
                <p>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                    </strong>
                </p>
                <p>
                    <strong>
                        1. “TAMIGADA” se puede reemplazar por:
                    </strong>
                    <br>
                    <input <?php echo $select1a?> name="1" value="1a" type="radio">  A. Protegida
                    <br>
                    <input <?php echo $select1b?> name="1" value="1b" type="radio">  B. Adoptada
                    <br>
                    <input <?php echo $select1c?> name="1" value="1c" type="radio">  C. Descartada
                    <br>
                    <input <?php echo $select1d?> name="1" value="1d" type="radio">  D. Enviada
                </p>
                <p>
                   <strong>
                       2. “HOFIDIERON” se puede reemplazar por:
                    </strong>
                    <br>
                    <input <?php echo $select2a?> name="2" value="2a" type="radio">  A. Negaron
                    <br>
                    <input <?php echo $select2b?> name="2" value="2b" type="radio">  B. Impidieron
                    <br>
                    <input <?php echo $select2c?> name="2" value="2c" type="radio">  C. Necesitaron
                    <br>
                    <input <?php echo $select2d?> name="2" value="2d" type="radio">  D. Afirmaron
                </p>
                <br>
                <p>        
                    <strong>
                        Leer el siguiente fragmento del cuento “Los argentinos son todos iguales” de Sergio Olguín.
                    </strong>
                </p>
        
                <p>        
                    Él no era barrabrava. Se había pagado cada peso del viaje a Japón con el sudor de su frente.
                    Había seis meses que venía preparándose para acompañar a Boca a la Copa Mundial de Clubes.
                    Desde que Riquelme la había clavado en el arco del Gremio en Porto Alegre, se prometió que iba a 
                    ir a Tokio, a alentar a su equipo. Y en esos seis meses había ahorrado plata, y hasta había
                    retomado las clases de inglés abandonadas quince años antes.
                </p>
                <p>
                    En Tokio había descubierto algo maravilloso: había negocios de comida rápida como en Buenos
                    Aires. Pero caminó durante media hora sin encontrar un mísero McDonald´s. Cuando se dio
                    cuenta, estaba en una esquina de Tokio rodeado de carteles incomprensibles y de gente que
                    pasaba velozmente. No tenía idea de cómo volver hasta su hotel desde ahí. Estaba totalmente
                    perdido.
                </p>
                <p>
                    Empezó a sentirse mareado entre tantos japoneses. En realidad, era un solo japonés que se
                    repetía en todos los tamaños. Eran como clones idénticos más grandes o más chicos. Los
                    japoneses eran todos iguales, pero las japonesas no.
                </p>
                <p>
                    Estaba transpirado. Antes de ponerse a gritar, sintió que una chica japonese lo miraba fuerte. Él
                    se quedó como una estatua. No estaba acostumbrado a que una mujer lo mirase así, ni en Tokio ni
                    en Buenos Aires. Ella se acercó y le empezó a hablar en japonés. Se la veía alterada, sorprendida,
                    incluso feliz. La chica nipona repetía algo así como “yuar, yuar”. Hasta que él se dio cuenta: “you
                    are”.
                </p>
                <p>
                    -Vos sos… (le dijo ella en inglés) Diego Armando.
                    <br>
                    No dijo “Maradona”, dijo “Diego Armando”.
                    <br>
                    -Diego Armando Maradona -insistió ella y agregó-. Soy yo Diego, Harukichi, ¿te acordás de mí?
                    <br>    
                    Y ella lo abrazó tan fuerte que decidió ser el Diego de Harukichi.
                    <br>
                    Con el correr de las horas entendió la confusión. Al llegar a la casa de Harukichi corrió hacia él un
                    niño de seis años:  
                    <br>
                    -Es tu hijo- le dijo Harukichi en un inglés clarísimo-. Le puse como vos: Diego Armando.
                    <br>
                    Recién ahí descubrió que en las paredes había fotos de Harukichi con un tipo de rulos que no era
                    Maradona, y que tampoco era él. “Pobre Diego”, pensó imaginando los problemas del Diez cuando
                    Harukichi hiciera pública la paternidad de su hijo.
                </p>
                <p>
                    <strong>
                        Responder las siguientes preguntas tildando la opción correcta.
                    </strong>
                </p>  
                <p>
                    <strong>
                        3. ¿Por qué el protagonista dice “era un solo japonés que se repetía en todos los tamaños”?
                    </strong>
                    <br>
                    <input <?php echo $select3a?> name="3" value="3a" type="radio">  A. Porque no entendía el idioma que se hablaba.
                    <br>
                    <input <?php echo $select3b?> name="3" value="3b" type="radio">  B. Porque estaba un poco mareado y hambriento.
                    <br>
                    <input <?php echo $select3c?> name="3" value="3c" type="radio">  C. Porque piensa que todos los japoneses son iguales.
                    <br>
                    <input <?php echo $select3d?> name="3" value="3d" type="radio">  D. Porque estaba viendo clones idénticos, más grandes o más chicos.
                </p>
                <p>
                    <strong>
                        4. Según el narrador, el protagonista no es barrabrava porque…
                    </strong>
                    <br>
                    <input <?php echo $select4a?> name="4" value="4a" type="radio">  A. estudió inglés para poder viajar a Japón.
                    <br>
                    <input <?php echo $select4b?> name="4" value="4b" type="radio">  B. decidió viajar a Japón a ver su equipo.
                    <br>
                    <input <?php echo $select4c?> name="4" value="4c" type="radio">  C. no iba con el resto de la hinchada de Boca.
                    <br>
                    <input <?php echo $select4d?> name="4" value="4d" type="radio">  D. viajó pagándose su pasaje con lo que ahorró.
                </p>
                <br>    
                <p>
                    <strong>
                        5. ¿Quién es el protagonista de este relato?
                    </strong>
                    <br>
                    <input <?php echo $select5a?> name="5" value="5a" type="radio">  A. Diego Armando Maradona.
                    <br>
                    <input <?php echo $select5b?> name="5" value="5b" type="radio">  B. Un jugador de fútbol.
                    <br>
                    <input <?php echo $select5c?> name="5" value="5c" type="radio">  C. Un hincha de un club japonés.
                    <br>
                    <input <?php echo $select5d?> name="5" value="5d" type="radio">  D. Un hincha de un club argentino.
                </p>
                <p>  
                    <strong>
                        6. ¿Por qué se confunde Harukichi?
                    </strong>
                    <br>
                    <input <?php echo $select6a?> name="6" value="6a" type="radio">  A. Porque el protagonista también se llamada Diego Armando.
                    <br>
                    <input <?php echo $select6b?> name="6" value="6b" type="radio">  B. Porque vio que el protagonista era un hombre cariñoso.
                    <br>
                    <input <?php echo $select6c?> name="6" value="6c" type="radio">  C. Porque lo vio perdido por las calles de la ciudad.
                    <br>
                    <input <?php echo $select6d?> name="6" value="6d" type="radio">  D. Porque para los japoneses todos los argentinos nos parecemos.
                </p>
                <br>
                <p>  
                    <strong>
                        Leer los siguientes mensajes de Twitter y responder las preguntas que les siguen seleccionando la
                        opción correcta.
                    </strong>
                </p>
                <p>
                    “Me ataca un tipo que se llama “Elio Izquierdo”. No lo ajusticio porque de eso ya se encargaron los
                    padres cuando le pusieron el nombre”.
                </p>
                <p>
                    <strong>
                        7. ¿Qué quiere decir el que escribe este tweet?
                    </strong>
                    <br>
                    <input <?php echo $select7a?> name="7" value="7a" type="radio">  A. Quiere denunciar a Elio Izquierdo por malos tratos.
                    <br>
                    <input <?php echo $select7b?> name="7" value="7b" type="radio">  B. Quiere decir que los padres eligieron un buen nombre.
                    <br>
                    <input <?php echo $select7c?> name="7" value="7c" type="radio">  C. Quiere decir que los padres eligieron un mal nombre.
                    <br>
                    <input <?php echo $select7d?> name="7" value="7d" type="radio">  D. Quiere decir que Elio Izquierdo no debería atacar más.
                </p>
                <br>
                <p>
                    “Yo no sé por qué el director de cámaras del partido en el que juega Ronaldinho a veces enfoca a
                    alguien que no es Ronaldinho.”
                </p>
                <p>
                    <strong>
                        8. ¿Qué quiere decir el que escribe este tweet?
                    </strong>
                    <br>
                    <input <?php echo $select8a?> name="8" value="8a" type="radio">  A. Que el director de cámaras marea enfocando a varios jugadores.
                    <br>
                    <input <?php echo $select8b?> name="8" value="8b" type="radio">  B. Que Ronaldinho debería ser enfocado menos que el resto.
                    <br>
                    <input <?php echo $select8c?> name="8" value="8c" type="radio">  C. Que Ronaldinho es el único buen jugador del partido.
                    <br>
                    <input <?php echo $select8d?> name="8" value="8d" type="radio">  D. Que el director debería ser más justo y enfocar a todos por igual.
                </p>
                <br>
                <p>
                    “El Tribunal de Disciplina dispuso que Vélez-Peñarol se juegue sin público. Esto es ventaja
                    deportiva para Vélez que ya está acostumbrado.”
                </p>
                <p>
                    <strong>
                        9. ¿Qué quiere decir el que escribe este tweet?
                    </strong>
                    <br>
                    <input <?php echo $select9a?> name="9" value="9a" type="radio">  A. Que el Tribunal de Disciplina castigará a Vélez.
                    <br>
                    <input <?php echo $select9b?> name="9" value="9b" type="radio">  B. Que el Tribunal de Disciplina castigará a Peñarol.
                    <br>
                    <input <?php echo $select9c?> name="9" value="9c" type="radio">  C. Que es difícil encontrar entradas para ver jugar a Vélez.
                    <br>
                    <input <?php echo $select9d?> name="9" value="9d" type="radio">  D. Que a Vélez no lo va a ver nadie cuando juega.
                </p>
                <br>
                <p>
                    “Boca aprovechó la expulsión de su propio defensor y se llevó la victoria.”
                </p>
                <p>
                    <strong>
                        10. ¿Qué quiere decir el que escribe este tweet?
                    </strong>
                    <br>
                    <input <?php echo $select10a?> name="10" value="10a" type="radio">  A. Que el defensor estaba jugando muy mal.
                    <br>
                    <input <?php echo $select10b?> name="10" value="10b" type="radio">  B. Que el defensor estaba jugando muy bien.
                    <br>
                    <input <?php echo $select10c?> name="10" value="10c" type="radio">  C. Que gracias al defensor, Boca se llevó la victoria.
                    <br>
                    <input <?php echo $select10d?> name="10" value="10d" type="radio">  D. Que el defensor convirtió el gol de la victoria.
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