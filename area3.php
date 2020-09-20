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


//si esta lgueado y aun no realizó el test:
//declaro las variables a utilizar
$error = "";
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

        //almaceno en base de datos las respuestas seleccionadas
        $consulta =  $baseDeDatos -> prepare
        ("UPDATE area3 SET pregunta1 = '$pregunta1', pregunta2='$pregunta2', 
        pregunta3='$pregunta3', pregunta4 ='$pregunta4', pregunta5='$pregunta5', 
        pregunta6='$pregunta6', pregunta7='$pregunta7', pregunta8 ='$pregunta8', 
        pregunta9 = '$pregunta9', pregunta10 = '$pregunta10' WHERE dni = '$dni'");
        $consulta->execute();

        $consulta2 =  $baseDeDatos -> prepare
        ("UPDATE usuarios SET area3=0 WHERE dni = '$dni'");
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
    <title>Área 3</title>
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
                ÁREA 3: SEMÁNTICA LÉXICA
                <br>
                Test Leer para Comprender II (TLC-II)
                <br>
                Abusamra y otros (2014)
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
                    Leer esta adaptación del cuento “El salto” de León Tolstoi.
                </strong>  
            </p>    
            <p>
                Un navío regresaba al puerto después de dar la vuelta al mundo; el tiempo era bueno y todos
                los pasajeros estaban en la cubierta del barco. Entre las personas, un mono, con sus gestos y
                sus saltos, era la diversión de todos. En un momento, el mono saltó sobre un muchacho de
                doce años, hijo del capitán del barco, le quitó el sombrero y se lo puso en la cabeza.
                <br>
                Todo el mundo reía; pero el niño, con la cabeza al aire, no sabía qué hacer; si imitarlos o
                llorar.
                <br>
                El mono se colgó de las velas del barco y sentado en la <u>cofa</u> empezó a romper el sombrero
                con los dientes y las uñas. El jovenzuelo lo amenazaba, lo injuriaba; pero el mono seguía su
                obra.
                <br>
                De pronto, el muchacho se puso rojo de cólora y se lanzó tras el mono. De un salto estuvo
                a su lado; pero el animal, más ágil y más diestro, se le escapó.
                <br>
                -¡No te vas a ir! -gritó el muchacho. El mono lo hacía subir y subir, pero el niño no renunciaba
                a la lucha. En la cima del mástil, el mono, colgó el sombrero en el más elevado sitio del navío y
                desde allí se echó a reír mostrando los dientes.<br>
                Del mástil donde estaba colgado el sombrero había más de dos metros; por lo tanto, no 
                podía alcanzarlo sin grandísimo peligro. Al ver que el niño subía hasta el mástil, los marineros
                quedaron paralizados por el espanto. Un falso movimiento y caería al piso del barco.
                <br>
                En aquel momento el capitán del barco, el padre del niño, salió de su camarote llevando en la
                mano una escopeta para matar gaviotas. Vio a su hijo en el mástil y apuntándole
                inmediatamente, exclamó:
                <br>
                <br>
                -¡Al agua!... ¡Al agua o te mato…!
                <br>
                <br>
                El niño vacilaba sin comprender.
                <br>
                <br>
                -¡Salta o te mato!... ¡Uno… dos…!
                <br>
                <br>
                Y en el momento en que el capitán gritaba: “Tres!”, el niño se dejó caer hacia el mar. <u>Como
                una bala penetró su cuerpo</u> en el agua; más apenas lo habían cubierto las ollas, cuando veinte
                bravos marineros lo seguían.
                <br>
                En el espacio de cuarenta segundos, que parecieron un siglo a los espectadores, el cuerpo del
                muchacho apareció en la superficie. Lo transportaron al barco y algunos minutos después empezó
                a echar agua por la boca y respiró.
                <br>
                Cuando su padre lo vio salvado, exhaló un grito, como si algo lo hubiese tenido ahogado.
            </p>    

            <form action="area3.php" method="POST">
                <p>
                        <strong>
                            Responder las siguientes preguntas seleccionando la opción correcta.
                        </strong>
                </p>
                <p>
                    <strong>1. La palabra “cofa” que subrayada en el tercer párrafo se refiere a:</strong>
                    <br>
                    <input <?php echo $select1a?> name="1" value="1a" type="radio">  A. Una parte del navío
                    <br>
                    <input <?php echo $select1b?> name="1" value="1b" type="radio">  B. Una parte del cuerpo de los marineros.
                    <br>
                    <input <?php echo $select1c?> name="1" value="1c" type="radio">  C. Una parte del sombrero.
                    <br>
                    <input <?php echo $select1d?> name="1" value="1d" type="radio">  D. Una parte del cuerpo del mono.
                </p>
                <p>
                    <strong>2- La expresión “como una bala penetró su cuerpo en el agua” subrayada en el 
                    antepenúltimo párrafo significa:</strong>
                    <br>
                    <input <?php echo $select2a?> name="2" value="2a" type="radio">  A. El cuerpo del niño ingresó al mar porque recibió un balazo.
                    <br>
                    <input <?php echo $select2b?> name="2" value="2b" type="radio">  B. El cuerpo del niño llegó a la profundidad del mar con mucha fuerza.
                    <br>
                    <input <?php echo $select2c?> name="2" value="2c" type="radio">  C. El mar se embraveció porque cayó una bala.
                    <br>
                    <input <?php echo $select2d?> name="2" value="2d" type="radio">  D. Los marineros se tiraron de bomba al agua.
                </p>
                <p>         
                    <strong>
                        3. En el texto hay dos expresiones que están conectadas por su significado. ¿Cuáles son?
                    </strong>
                    <br>
                    <input <?php echo $select3a?> name="3" value="3a" type="radio">  A. Mástil y barco.
                    <br>
                    <input <?php echo $select3b?> name="3" value="3b" type="radio">  B. Barco y personas.
                    <br>
                    <input <?php echo $select3c?> name="3" value="3c" type="radio">  C. Sombrero y niño.
                    <br>
                    <input <?php echo $select3d?> name="3" value="3d" type="radio">  D. Mástil y sombrero.
                </p>
                <br>
                <p>        
                    <strong>
                        Leer las siguientes estrofas de canciones y responder las preguntas a continuación,
                        seleccionando la opción correcta.
                    </strong>
                    <br>
                    <br>
                    Todo lo que tengo<br>
                    es todo lo que intento.<br>
                    Un temporal,<br>
                    un circo malo,<br>
                    una playa sin verano.<br>
                    <span>Hacer un puente, La franela</span>
                </p>
           
                <p>
                    <strong>
                        4. La expresión “una playa sin verano” significa:
                    </strong>
                    <br>
                    <input <?php echo $select4a?> name="4" value="4a" type="radio">  A. Una playa con nieve.
                    <br>
                    <input <?php echo $select4b?> name="4" value="4b" type="radio">  B. Una playa sin arena.
                    <br>
                    <input <?php echo $select4c?> name="4" value="4c" type="radio">  C. Una playa triste y solitaria.
                    <br>
                    <input <?php echo $select4d?> name="4" value="4d" type="radio">  D. Una playa llena de gente.
                </p>
                <br>
                <p>
                    Con el tiempo se nos fue para una cresta<br>
                    de una ola que no para de crecer.<br>
                    Hoy su cara está en todas las remeras<br>
                    es un muerto que no para de nacer.<br>
                    <span>Murguita del sur, Bersuit Vergarabat</span>
                </p>
                <p>
                    <strong>
                        5. ¿Qué significa que alguien sea “un muerto que no para de nacer”?
                    </strong>
                    <br>
                    <input <?php echo $select5a?> name="5" value="5a" type="radio">  A. Que es una persona que es recordada constantemente.
                    <br>
                    <input <?php echo $select5b?> name="5" value="5b" type="radio">  B. Que es una persona que sobrevive.
                    <br>
                    <input <?php echo $select5c?> name="5" value="5c" type="radio">  C. Que es una persona que la gente olvidó fácilmente.
                    <br>
                    <input <?php echo $select5d?> name="5" value="5d" type="radio">  D. Que es una persona que nació y murió inmediatamente.
                </p>
                <br>
                <p>
                    <strong>
                        Leer el siguiente fragmento de un relato del libro ADN El detector de mentiras de Viviana
                        Bernath.
                    </strong>
                    <br>
                    Aunque ya había averiguado bastante sobre su pasado, Daniel sentía que su historia aún tenía
                    demasiados huecos. Le resultaba especialmente extraño el comercio de Rosa sobre lo rápido que
                    se había adaptado a su nuevo hogar. Además, Daniel siempre se había visto muy parecido a José,
                    se sentía como minado por sus rasgos físicos y por sus gestos. La misma nariz aguileña, el mismo
                    hoyuelo en la barbilla, incluso los ojos grises de su padre… De idéntico carácter, además, los dos
                    tenían temperamento fuerte, de esos capaces de <u>brotarse</u> y hasta de dar una piña si los
                    provocaban un poco de más. En realidad, ahora que lo pensaba, el haber sido tan parecidos tal vez
                    había contribuido a que jamás desconfiara de nada. Y ahora, incluso sabiendo la verdad, Daniel
                    seguía encontrando muchas semejanzas que lo inquietaban. Debía continuar investigando. ¿Pero
                    cómo? ¿Con quién? Había hablado con toda la familia, había pasado largas tardes con Perla
                    rememorando, y nada nuevo había surgido. Y lo peor, lejos ya de las amenazas de José, nadie
                    parecía querer ocultarle ningún dato, ni el más mínimo detalle. Como el curso de un río contenido
                    durante años, todos respondían a sus preguntas con cataratas de palabras que, sin embargo, no
                    llegaban a ningún sitio que calmara su desasosiego.
                    <br>
                    <br>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                        <br>
                        <br>
                        6- ¿Qué expresión similar podrías utilizar para reemplazar “Como el curso de un río
                        contenido durante años”?
                    </strong>
                    <br>
                    <input <?php echo $select6a?> name="6" value="6a" type="radio">  A. Como el descubrimiento de un río viejo.
                    <br>
                    <input <?php echo $select6b?> name="6" value="6b" type="radio">  B. Como el recorrido de un río caudaloso y revuelto.
                    <br>
                    <input <?php echo $select6c?> name="6" value="6c" type="radio">  C. Como el curso de un río que pasa bajo un puente.
                    <br>
                    <input <?php echo $select6d?> name="6" value="6d" type="radio">  D. Como un viaje en barco por un río.
                </p>
                <p>
                    <strong>
                        7. “Desasosiego” significa:
                    </strong>
                    <br>
                    <input <?php echo $select7a?> name="7" value="7a" type="radio">  A. Serenidad
                    <br>
                    <input <?php echo $select7b?> name="7" value="7b" type="radio">  B. Visión
                    <br>
                    <input <?php echo $select7c?> name="7" value="7c" type="radio">  C. Deseo
                    <br>
                    <input <?php echo $select7d?> name="7" value="7d" type="radio">  D. Inquietud
                </p>
                <p>
                    <strong>
                        8. La palabra “brotarse” subrayada en el párrafo significa:
                    </strong><br>
                    <input <?php echo $select8a?> name="8" value="8a" type="radio">  A. Contagiarse varicela.
                    <br>
                    <input <?php echo $select8b?> name="8" value="8b" type="radio">  B. Llenarse de brotes.
                    <br>
                    <input <?php echo $select8c?> name="8" value="8c" type="radio">  C. Manifestar mucha bronca y enojo.
                    <br>
                    <input <?php echo $select8d?> name="8" value="8d" type="radio">  D. Lastimarse dándose piñas.
                </p>
                <br>    
                <p>
                    <strong>
                        Leer las siguientes definiciones y elegir entre las opciones a qué palabra refiere cada una de
                        ellas. Seleccionar la opción correcta.
                        <br>
                        <br>
                        9. “Conjunto de piezas duras y resistentes, por lo regular trabadas o articuladas entre sí,
                        que da consistencia al cuerpo de los animales, sosteniendo o protegiendo sus partes
                        blandas”:
                    </strong>
                    <br>
                    <input <?php echo $select9a?> name="9" value="9a" type="radio">  A. Caparazón
                    <br>
                    <input <?php echo $select9b?> name="9" value="9b" type="radio">  B. Dientes
                    <br>
                    <input <?php echo $select9c?> name="9" value="9c" type="radio">  C. Ajedrez
                    <br>
                    <input <?php echo $select9d?> name="9" value="9d" type="radio">  D. Esqueleto
                </p>
                <p>  
                    <strong>
                        10. “Tiempo que sirve para denotar una acción, un proceso o un estado de cosas posteriores al
                        momento en que se habla”:
                    </strong>
                    <br>
                    <input <?php echo $select10a?> name="10" value="10a" type="radio">  A. Lluvia
                    <br>
                    <input <?php echo $select10b?> name="10" value="10b" type="radio">  B. Futuro
                    <br>
                    <input <?php echo $select10c?> name="10" value="10c" type="radio">  C. Momento
                    <br>
                    <input <?php echo $select10d?> name="10" value="10d" type="radio">  D. Lenguaje
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