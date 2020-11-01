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


$error= "";
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
    //si responde todas las preguntas almaceno los valores de las mismas y mando a bdd
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
            ("UPDATE area9 SET pregunta1 = '$pregunta1', pregunta2='$pregunta2', 
            pregunta3='$pregunta3', pregunta4 ='$pregunta4', pregunta5='$pregunta5', 
            pregunta6='$pregunta6', pregunta7='$pregunta7', pregunta8 ='$pregunta8', 
            pregunta9 = '$pregunta9', pregunta10 = '$pregunta10' WHERE dni = '$dni'");
        $consulta->execute();

        $consulta2 =  $baseDeDatos -> prepare
        ("UPDATE usuarios SET area9=0 WHERE dni = '$dni'");
        $consulta2 -> execute();

        //redirecciono en base al rol del usuarioz
        if($rol=="postulante"){
            echo "<script>location.href='menu.php';</script>";
        }else{
            echo "<script>location.href='admin.php';</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Área 9</title>
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
                ÁREA 9: MODELOS MENTALES
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
                    Leer el siguiente relato:
                </strong>  
            </p>    
            <p>
                El 31 de julio de 2001, el Nuevo siglo tenía el mismo aspecto de siempre: 
                fotos, titulares diversos y pies de foto más pequeños. La única diferencia 
                era que yo no podría leer lo que decía. Me daba cuenta de que eran las 
                mismas veintisiete letras que había aprendido en la escuela. Solo que ahora, 
                cuando las enfocaba, en un momento me parecían griego y al siguiente coreano. 
                ¿Se trataba de una versión serbocroata del Nuevo siglo, destinada a la 
                exportación? ¿Me estaban haciendo una broma pesada? No tengo ningún amigo 
                que sea capaz de algo así. Me pregunté qué podría hacerles yo para mejorar 
                esa gracia. Entonces consideré una posibilidad alternativa. Comprobé las páginas 
                interiores del Nuevo siglo para ver si tenían un aspecto tan extraño como la 
                portada. Comprobé los anuncios clasificados y las tiras cómicas. Tampoco podía 
                leerlos.
            </p>
            <p>
                Una oleada de pánico debería haberse apoderado de mí. En cambio, 
                me inundó una calma razonable, como si no pasara nada. “Puesto que no se 
                trata de ninguna broma, entonces deduzco que acabo de sufrir una hemorragia”.
            </p>
            <form action="area9.php" method="POST">
                <p>
                    <strong>
                        Responder las siguientes preguntas seleccionando la opción correcta.
                    </strong>
                </p>
                <p>
                    <strong>
                        1. El Nuevo siglo es:
                    </strong>
                    <br>
                    <input <?php echo $select1a?> name="1" value="1a" type="radio">  A. Un diario
                    <br>
                    <input <?php echo $select1b?> name="1" value="1b" type="radio">  B. Un libro.
                    <br>
                    <input <?php echo $select1c?> name="1" value="1c" type="radio">  C. Una agenda.
                    <br>
                    <input <?php echo $select1d?> name="1" value="1d" type="radio">  D. Una revista.
                </p>
                <p>
                    <strong>
                        2. ¿Qué piensa el protagonista que le ocurrió?
                    </strong>
                    <br>
                    <input <?php echo $select2a?> name="2" value="2a" type="radio">  A. Sufrió una hemorragia que le impedía leer.
                    <br>
                    <input <?php echo $select2b?> name="2" value="2b" type="radio">  B. El texto estaba escrito un coreano.
                    <br>
                    <input <?php echo $select2c?> name="2" value="2c" type="radio">  C. Sus amigos le habían hecho una broma. 
                    <br>
                    <input <?php echo $select2d?> name="2" value="2d" type="radio">  D. Olvidó ponerse los anteojos para leer.
                </p>
                <p>        
                    <strong>
                        3. ¿Cómo se siente el protagonista?
                    </strong>
                    <br>
                    <input <?php echo $select3a?> name="3" value="3a" type="radio">  A. Temeroso.
                    <br>
                    <input <?php echo $select3b?> name="3" value="3b" type="radio">  B. Preocupado.
                    <br>
                    <input <?php echo $select3c?> name="3" value="3c" type="radio">  C. Triste.
                    <br>
                    <input <?php echo $select3d?> name="3" value="3d" type="radio">  D. Tranquilo.
                </p>
                <p>        
                    <strong>
                        Leer a continuación el fragmento anterior y responder la pregunta a continuación seleccionando la opción correcta.
                        <br>
                    </strong>    
                </p>
                <p>
                    Pensé que lo mejor sería consultar a un especialista en el tema. 
                    Sin dejar pasar más tiempo, me puse los anteojos de leer y busqué mi agenda. 
                    Busqué el teléfono de mi médico de cabecera y lo llamé. Cuando me atendió su 
                    secretaria, me dí cuenta de todo lo que había ocurrido. Me quedé mudo. Corté la 
                    comunicación y me dirigí nuevamente a mi sillón. Tomé el Nuevo siglo y con mucha 
                    felicidad empecé mi día nuevamente.  
                </p>
                <p>
                    <strong>    
                        4. ¿Qué le ocurrió al protagonista realmente?
                    </strong>
                    <br>
                    <input <?php echo $select4a?> name="4" value="4a" type="radio">  A. Sufrió una hemorragia que le impedía leer.
                    <br>
                    <input <?php echo $select4b?> name="4" value="4b" type="radio">  B. El texto estaba escrito en coreano.
                    <br>
                    <input <?php echo $select4c?> name="4" value="4c" type="radio">  C. Sus amigos le habían hecho una broma. 
                    <br>
                    <input <?php echo $select4d?> name="4" value="4d" type="radio">  D. Olvidó ponerse los anteojos para leer.
                </p>
                <br>   
                <p>
                    <strong>
                        Leer el siguiente fragmento y responder la pregunta a continuación seleccionando la opción correcta.
                    </strong>
                </p>
                <p>
                    Andrés empezó el secundario en una escuela técnica. Ya tuvo la primera semana 
                    de clases y se encontró con un montón de materias nuevas. Ahora se disponía a 
                    hacer la tarea de dibujo. La consigna decía así: dibujar la inicial de tu 
                    nombre de forma tridimensional. Las caras internas de la figura tienen que 
                    estar pintadas de color gris. Las caras externas deben tener líneas oblicuas, 
                    orientadas en dos direcciones diferentes, superpuestas. Además, la letra tiene 
                    que estar rotada a 45 grados manteniendo su orientación tradicional. 
                </p>
                <p>
                    <strong>
                    5. ¿Cuál de estas figuras puede ser el dibujo de Andrés para que la consigna esté bien realizada?
                    </strong>
                    <div class="imagen">
                    </div>
                    <br>
                    <input <?php echo $select5a?> name="5" value="5a" type="radio">  A. 
                    <input <?php echo $select5b?> name="5" value="5b" type="radio">  B. 
                    <input <?php echo $select5c?> name="5" value="5c" type="radio">  C. 
                    <input <?php echo $select5d?> name="5" value="5d" type="radio">  D. 
                </p>
                <p>
                    <strong>
                        En el fragmento que sigue hay una palabra inventada. Leerlo y responder 
                        la pregunta que sigue redondeando la opción correcta.
                    </strong>
                    <br>
                        El pengo medio y ordinario consiste en una contracción general del rostro 
                        y un sonido espasmódico acompañado de lágrimas y mocos estos últimos al 
                        final (…). Llegado el pengo, se tapará con decoro el rostro usando ambas 
                        manos con la palma hacia dentro. Los niños lo harán con la manga del saco 
                        contra la cara, y de preferencia en un rincón del cuarto. Duración media 
                        del pengo, tres minutos.
                </p>
                <p>
                    <strong>
                        6. ¿Qué palabra sustituye el término “pengo”?
                    </strong>
                    <br>
                    <input <?php echo $select6a?> name="6" value="6a" type="radio">  A. Estornudo.
                    <br>
                    <input <?php echo $select6b?> name="6" value="6b" type="radio">  B. Sueño.
                    <br>
                    <input <?php echo $select6c?> name="6" value="6c" type="radio">  C. Canto.
                    <br>
                    <input <?php echo $select6d?> name="6" value="6d" type="radio">  D. Llanto.
                </p>
                <p>
                    <strong>
                        Leer la siguiente definición y adivinar de qué se trata. Responder en cada caso 
                        seleccionando la opción correcta.
                    </strong>
                    <br>        
                        Toda mi vida en un mes, mi caudal son cuatro cuartos, y aunque me vez pobrecita 
                        ando siempre en lo más alto.
                </p>
                <p>
                    <strong>    
                        7. ¿De qué se trata?
                    </strong>
                    <br>
                    <input <?php echo $select7a?> name="7" value="7a" type="radio">  A. La luna.
                    <br>
                    <input <?php echo $select7b?> name="7" value="7b" type="radio">  B. La chimenea.
                    <br>
                    <input <?php echo $select7c?> name="7" value="7c" type="radio">  C. La araña.
                    <br>
                    <input <?php echo $select7d?> name="7" value="7d" type="radio">  D. La lluvia.
                </p>
                <br>
                <p>
                    <strong>
                        José y Claudia están de vacaciones. Querían llegar a la plaza 
                        principal de la ciudad en la que estaban pero se encontraban perdidos, 
                        por lo que tuvieron que pedir indicaciones. Leer las indicaciones que 
                        recibieron y responder las preguntas a continuación seleccionando 
                        la opción correcta.
                    </strong>
                </p>
                <p>
                    Sigan por esta calle hasta llegar a una farmacia que está en una esquina, 
                    allí deben doblar a la derecha. Deben seguir en esa dirección tres cuadras 
                    más hasta encontrarse con un puente. Tienen que cruzar el puente y seguir 
                    otras dos cuadras hasta llegar a una avenida muy importante que en la división 
                    de ambas manos de la calle tienen enormes rosales de color rojo. Toman esa 
                    avenida hacia la derecha. Continúan seis cuadras, van a pasar la casa de 
                    gobierno de la ciudad y el correo. Se darán cuenta dónde terminan esas seis 
                    cuadras, porque la última cuadra está ocupada por una escuela muy grande que 
                    está pintada de color gris y abarca toda la manzana. Cuando lleguen a la 
                    escuela doblen nuevamente a la derecha y sin hacer más que esa cuadra se 
                    encontrarán con la plaza que están buscando. Tengan mucho cuidado porque 
                    tanto la avenida como las demás calles por las que circularán son doble mano. 
                    <br>
                    <br>
                    <strong>
                        8. ¿Dónde está ubicada la plaza respecto de la escuela?
                    </strong>    
                    <br>
                    <input <?php echo $select8a?> name="8" value="8a" type="radio">  A. A dos cuadras de la escuela. 
                    <br>
                    <input <?php echo $select8b?> name="8" value="8b" type="radio">  B. Adentro de la escuela.
                    <br>
                    <input <?php echo $select8c?> name="8" value="8c" type="radio">  C. Enfrente de la avenida que pasa por el frente de la escuela.
                    <br>
                    <input <?php echo $select8d?> name="8" value="8d" type="radio">  D. Enfrente de la escuela. 
                </p>
                <p>
                    <strong>
                        9. Para regresar al punto de partida deberán: 
                    </strong>    
                    <br>
                    <input <?php echo $select9a?> name="9" value="9a" type="radio">  A. Doblar dos veces a la izquierda y una a la derecha.
                    <br>
                    <input <?php echo $select9b?> name="9" value="9b" type="radio">  B. No doblar en ningún momento.
                    <br>
                    <input <?php echo $select9c?> name="9" value="9c" type="radio">  C. Doblar siempre a la izquierda.
                    <br>
                    <input <?php echo $select9d?> name="9" value="9d" type="radio">  D. Doblar cuando vean un puente.
                </p>
                <p>
                    <strong>
                    10. Para responder estas preguntas:
                    </strong>    
                    <br>
                    <input <?php echo $select10a?> name="10" value="10a" type="radio">  A. Te imaginaste un mapa de tu ciudad.
                    <br>
                    <input <?php echo $select10b?> name="10" value="10b" type="radio">  B. Formaste una imagen mental del recorrido descripto.
                    <br>
                    <input <?php echo $select10c?> name="10" value="10c" type="radio">  C. Contaste la cantidad de cuadras de todo el recorrido.
                    <br>
                    <input <?php echo $select10d?> name="10" value="10d" type="radio">  D. Tuviste que memorizar todas las palabras del texto. 
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