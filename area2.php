<?php
session_start();
require("pdo.php");
require("respuestasCorrectas.php");


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

if($_POST){
    //valido si no se responden todas las preguntas
    if(!(isset($_POST["1"])) || !(isset($_POST["2"])) || !(isset($_POST["3"]))
        || !(isset($_POST["4"])) || !(isset($_POST["5"])) ||  !(isset($_POST["6"]))
        || !(isset($_POST["7"])) ||!(isset($_POST["8"]))  ){
            
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
            $error="Debes responder todas las preguntas";
    }
    //si responde todas las preguntas almaceno las respuestas seleccionadas en variables
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
        
        //almaceno en base de datos las respuestas seleccionadas
        $consulta =  $baseDeDatos -> prepare
        ("UPDATE area2 SET pregunta1 = '$pregunta1', pregunta2='$pregunta2', pregunta3='$pregunta3',
         pregunta4 ='$pregunta4', pregunta5='$pregunta5', pregunta6='$pregunta6', pregunta7='$pregunta7',
          pregunta8 ='$pregunta8'
            WHERE dni = '$dni'");
        $consulta -> execute();

        //Actualizo en base de datos el estado del test    
        $consulta2 =  $baseDeDatos -> prepare
        ("UPDATE usuarios SET area2=0 WHERE dni = '$dni'");
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
    <title>Área 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/areas.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="row justify-content-center">
        <header class="col-10 col-md-6 col-xl-6 caja-principal">
            <p class="texto-header">
                ÁREA 2
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
                    Leer la siguiente historia contada por Adrían Paenza.<br>
                    Sobre monos y bananas
                </strong>  
            </p>    
            <p>
                Supongamos que tenemos seis monos en una pieza. Del cielo raso cuelga un racimo 
                de bananas. Justo debajo de él hay una escalera (como la de un pintor o un 
                carpintero). No hace falta mucho tiempo para que uno de los monos suba la escalera 
                hacia las bananas. 
            </p>
            <p>
                Y ahí comienza el experimento: en el mismo momento en que toca la escalera, 
                todos los monos son rociados con agua helada. Naturalmente, eso detiene al mono.
                Luego de un rato, el mismo mono o alguno de los otros hace otro intento con el 
                mismo resultado: todos los monos son rociados con el agua helada a poco que uno 
                de ellos toque la escalera. Cuando este proceso se repite un par de veces más, 
                los monos ya están advertidos. Ni bien alguno de ellos quiere intentarlo, los 
                otros tratan de evitarlo y terminan a los golpes si es necesario. 
            </p>
            <p>
                Una vez que llegamos a este estadio, retiramos uno de los monos de la pieza y lo 
                sustituimos por uno nuevo (que obviamente no participó del experimento hasta aquí). 
                El nuevo mono ve las bananas e inmediatamente trata de subir por las escaleras. Para 
                su horror, todos los otros monos lo atacan. Y obviamente se lo impiden. Luego de un 
                par de intentos más, el nuevo mono ya aprendió: si intenta subir por las escaleras
                lo van a golpear sin piedad.
            </p>
            <p>
                Luego, se repite el procedimiento: se retira un segundo mono y se incluye uno 
                nuevo otra vez. El recién llegado va hacia las escaleras y el proceso se repite: 
                ni bien la toca (la escalera) es atacado masivamente. No solo eso: el mono que había 
                entrado justo antes que él (¡que nunca había experimentado el agua helada!) 
                participaba del episodio de violencia con gran entusiasmo.
            </p>
            <p>
                Un tercer mono es reemplazado y ni bien intenta subir las escaleras, los otros cinco 
                lo golpean. Con todo, dos de los monos no tienen ni idea de por qué uno no puede 
                subir las escaleras. Se reemplaza un cuarto mono, luego un quinto y por último, 
                el sexto que a esta altura es el único que quedaba del grupo original. Al sacar 
                a este ya no queda ninguno que haya experimentado el episodio del agua helada. 
                Sin embargo, una vez que el último lo intenta un par de veces y es golpeado 
                furiosamente por los otros cinco, queda establecida la regla: no se puede subir 
                las escaleras. Quien lo hace se expone a una represión brutal. Solo que ahora 
                ninguno de los seis monos tiene argumentos para sostener esta barbarie.
            </p>
            <form action="area2.php" method="POST">
                <p>
                    <br>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                    </strong>
                </p>
                <p>
                    <strong>
                        1. ¿Por qué al principio los investigadores mojan a todos los monos con agua helada y no solo el que sube?
                    </strong>
                    <br>
                    <input <?php echo $select1a?> name="1" value="1a" type="radio">  A. Porque los investigadores no identifican al que subió la escalera.
                    <br>
                    <input <?php echo $select1b?> name="1" value="1b" type="radio">  B. Porque los investigadores quieren crear odio entre los monos.
                    <br>
                    <input <?php echo $select1c?> name="1" value="1c" type="radio">  C. Porque los investigadores quieren estudiar una conducta colectiva.
                    <br>
                    <input <?php echo $select1d?> name="1" value="1d" type="radio">  D. Porque todos los monos quieren subir al mismo tiempo la escalera. 
                </p>
                <p>
                    <strong>
                        2- ¿En qué orden ocurren los hechos del experimento inicial? Elegir una de las cuatro opciones posibles.
                    </strong>
                    <br>
                    <input <?php echo $select2a?> name="2" value="2a" type="radio">  A. Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera -   Los monos se detienen - Los monos son rociados con agua helada.
                    <br>
                    <input <?php echo $select2b?> name="2" value="2b" type="radio">  B. Los investigadores colocan un racimo de bananas en el techo- Los monos se detienen- Los monos tocan la escalera- Los monos son rociados con agua helada.
                    <br>
                    <input <?php echo $select2c?> name="2" value="2c" type="radio">  C. Los monos son rociados con agua helada - Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera - Los monos se detienen.
                    <br>
                    <input <?php echo $select2d?> name="2" value="2d" type="radio">  D. Los investigadores colocan un racimo de bananas en el techo - Los monos tocan la escalera - Los monos son rociados con agua helada - Los monos se detienen.
                </p>
                <p>        
                    <strong>
                        3. ¿Por qué los monos comienzan a golpear a los que suben?  
                    </strong>
                    <br>
                    <input <?php echo $select3a?> name="3" value="3a" type="radio">  A. Porque no quieren que los investigadores los mojen con agua helada.
                    <br>
                    <input <?php echo $select3b?> name="3" value="3b" type="radio">  B. Porque no quieren perderse el juego
                    <br>
                    <input <?php echo $select3c?> name="3" value="3c" type="radio">  C. Porque creen que el que intenta subir les va a tirar agua helada. 
                    <br>
                    <input <?php echo $select3d?> name="3" value="3d" type="radio">  D. Porque el instinto hace que golpeen a los que están cerca.
                </p>
                <p>        
                    <strong>
                        4. ¿Por qué los que no fueron mojados con agua helada golpean furiosamente igual?
                    </strong>
                    <br>
                    <input <?php echo $select4a?> name="4" value="4a" type="radio">  A. Porque quieren ser también mojados por los investigadores.
                    <br>
                    <input <?php echo $select4b?> name="4" value="4b" type="radio">  B. Porque se dan cuenta de que si no pegan, no podrán subir las escaleras.
                    <br>
                    <input <?php echo $select4c?> name="4" value="4c" type="radio">  C. Porque actúan por venganza, recordando situaciones previas.
                    <br>
                    <input <?php echo $select4d?> name="4" value="4d" type="radio">  D. Porque actúan copiando la conducta de los otros. 
                </p>
                <br>   
                <p>
                    <strong>
                        Leer las estrofas de la siguiente canción
                    </strong>
                </p>
                <p>
                    Amanece en la ruta, no me importa dónde estoy<br>
                    me he dormido viajando y he soñado tan intenso<br>
                    y en ese sueño yo me veía en ese auto, pero no <br>
                    no era el mismo porque estaba todo roto en su interior.<br>
                    <span>Amanece en la ruta, Suéter</span>
                </p>
                <p>
                    <strong>
                        5- Indicar cuál de las siguientes secuencias presenta el orden cronológico en el que sucedieron los hechos.
                </strong>
                    <br>
                    <input <?php echo $select5a?> name="5" value="5a" type="radio">  A. Amaneció- el protagonista soñó- el protagonista se quedó dormido- el protagonista se puede ver en su sueño.
                    <br>
                    <input <?php echo $select5b?> name="5" value="5b" type="radio">  B. El protagonista soñó- amaneció- el protagonista se quedó dormido- el protagonista se puede ver en su sueño.
                    <br>
                    <input <?php echo $select5c?> name="5" value="5c" type="radio">  C. El protagonista se puede ver en su sueño- amaneció- el protagonista se quedó dormido- el protagonista soñó.    
                    <br>
                    <input <?php echo $select5d?> name="5" value="5d" type="radio">  D. El protagonista se quedó dormido- el protagonista soñó- el protagonista se puede ver en su sueño- amaneció.
                </p>
                <br>
                <p>
                    <strong>
                        Leer atentamente el siguiente texto breve de Enrique Anderson Imbert.
                    </strong>
                    <br>
                        Un día de noviembre Armando iba al cementerio -precisamente para depositar 
                        unas flores en la tumba de Laura que se había muerto en julio- cuando el 
                        ómnibus en que viajaba, chocó contra otro. Uno de estos accidentes que ocurren
                        todos los días. Al bajar del ómnibus vio a Laura entre las personas que se 
                        aglomeraban atraídas por la sangre. Armando se acercó para hablarle pero ella
                        le hizo señas de que no lo hiciera y desapareció.
                    <br>
                        -¡Cómo es esto! ¡He visto viva a mi querida muerta! -empezó a pensar y entonces
                        fue cuando, en seco, Armando se dio cuenta. 
                </p>
                <p>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                        <br>
                        6. ¿Qué hizo Armando después de que chocaran los ómnibus?
                    </strong>
                    <br>
                    <input <?php echo $select6a?> name="6" value="6a" type="radio">  A. Bajó e intentó hablarle a Laura.
                    <br>
                    <input <?php echo $select6b?> name="6" value="6b" type="radio">  B. Bajó y siguió camino hacia el cementerio.
                    <br>
                    <input <?php echo $select6c?> name="6" value="6c" type="radio">  C. Bajó y ayudó a quienes estaban ensangrentados.
                    <br>
                    <input <?php echo $select6d?> name="6" value="6d" type="radio">  D. Bajó y depositó las flores en la tumba de Laura.
                </p>
                <p>
                    <strong>
                    7. ¿De qué se dio cuenta Armando cuando vio a su “querida muerta”?
                    </strong>
                    <br>
                    <input <?php echo $select7a?> name="7" value="7a" type="radio">  A. Se asustó al ver a su fantasma.
                    <br>
                    <input <?php echo $select7b?> name="7" value="7b" type="radio">  B. Se quedó aturdido mirando la gente del accidente.
                    <br>
                    <input <?php echo $select7c?> name="7" value="7c" type="radio">  C. Se dio cuenta de que él estaba muerto.
                    <br>
                    <input <?php echo $select7d?> name="7" value="7d" type="radio">  D. Se quedó pensando en su amada.
                </p>
                <p>
                    <strong>
                        8- ¿Por qué Laura habrá huido sin hablar con Armando?
                    </strong>
                    <br>
                    <input <?php echo $select8a?> name="8" value="8a" type="radio">  A. Porque estaba enojada con él y no quería perdonarlo.
                    <br>
                    <input <?php echo $select8b?> name="8" value="8b" type="radio">  B. Porque no quería que Armando estuviera muerto.
                    <br>
                    <input <?php echo $select8c?> name="8" value="8c" type="radio">  C. Porque no lo pudo reconocer entre tanta gente.
                    <br>
                    <input <?php echo $select8d?> name="8" value="8d" type="radio">  D. Porque iban a provocar otro accidente.

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