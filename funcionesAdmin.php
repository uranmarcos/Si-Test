<?php
//variables para remarcar el boton del aside seleccionado
$bgUsuarios ="";
$bgPassword="";
$bgTest="";
$bgResultados="";

//variable para indicar la opcion seleccionada y cargar la caja correspondiente
$seccion="secciones/logo.php";


//visibilidad de caja seleccionada según boton del menu lateral
if($_GET){
    if(isset($_GET["usuarios"])){
        $seccion="secciones/usuarios.php";
        $bgUsuarios =  "bgLightPurple";
    }
    if(isset($_GET["password"])){
        $seccion="secciones/password.php";
        $bgPassword =  "bgLightPurple";
    }
    if(isset($_GET["test"])){
        $seccion="secciones/test.php";
        $bgTest=  "bgLightPurple";
    }
    if(isset($_GET["resultados"])){
        $seccion="secciones/resultados.php";
        $bgResultados =  "bgLightPurple";
    }
}


//Variables generales
$colorMensaje="";


//USUARIOS
//Crear Usuarios
$mensajeUsuarios="";
$visibilidadCajaCrearUsuario="ocultar";
$visibilidadBotonMasCrearUsuario="mostrar";
$visibilidadBotonMenosCrearUsuario="ocultar";

if(isset($_POST["crearUsuario"])){
    $nombre= $_POST["name"];
    $apellido = $_POST["lastName"];
    $dni = $_POST["dni"];
    $rol = $_POST["rol"];
    $seccion="secciones/usuarios.php";
    $visibilidadCajaCrearUsuario="mostrar";
    $visibilidadBotonMasCrearUsuario="ocultar";
    $visibilidadBotonMenosCrearUsuario="mostrar";

    if (strlen($dni)!=8){
        $mensajeUsuarios= "El dni ingresado debe poseer 8 dígitos";
        $colorMensaje="red";
    }else{
        $consulta = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
        $consulta->execute();
        $datosUsuarios =$consulta -> fetchAll(PDO::FETCH_ASSOC);

        if(empty($datosUsuarios)){
            if($rol=="postulante"){
                $password = rand(100000, 999999);
            }else if($rol == "voluntario"){
                                
                $password = substr($_POST["dni"], -6);
            }    
                $consultaUsuario =  $baseDeDatos -> prepare
                ("INSERT INTO usuarios
                VALUES ('$nombre', '$apellido', '$dni','$password', '$rol', '-2','-2','-2','-2','-2','-2','-1', '1', 's/d', '45' )");
                $consultaUsuario -> execute();
                
                $consultaRaven =  $baseDeDatos -> prepare
                ("INSERT INTO test1
                VALUES ('$dni', '0', '0','0','0','0','0','0','0', '0', '0',
                '0', '0','0','0','0','0','0','0', '0', '0',
                '0', '0','0','0','0','0','0','0', '0', '0',
                '0', '0','0','0','0','0','0','0', '0', '0',
                '0', '0','0','0','0','0','0','0', '0', '0',
                '0', '0','0','0','0','0','0','0', '0', '0'
                )");
                $consultaRaven -> execute();

                $consultaArea2 =  $baseDeDatos -> prepare
                ("INSERT INTO area2
                VALUES ('$dni', '0', '0','0', '0', '0','0','0','0')");
                $consultaArea2 -> execute();

                $consultaArea3 =  $baseDeDatos -> prepare
                ("INSERT INTO area3
                VALUES ('$dni', '0', '0','0', '0', '0','0','0','0', '0', '0')");
                $consultaArea3 -> execute();

                $consultaArea6 =  $baseDeDatos -> prepare
                ("INSERT INTO area6
                VALUES ('$dni', '0', '0','0', '0', '0','0','0','0', '0', '0')");
                $consultaArea6 -> execute();

                $consultaArea8=  $baseDeDatos -> prepare
                ("INSERT INTO area8
                VALUES ('$dni', '0', '0','0', '0', '0','0','0','0', '0', '0')");
                $consultaArea8 -> execute();

                $consultaArea9 =  $baseDeDatos -> prepare
                ("INSERT INTO area9
                VALUES ('$dni', '0', '0','0', '0', '0','0','0','0', '0', '0')");
                $consultaArea9 -> execute();

                $mensajeUsuarios="Se ha creado exitosamente el siguiente usuario:  $nombre $apellido - dni: $dni - clave: $password";
                $colorMensaje="green";
            }else{
            $mensajeUsuarios="El dni ya está registrado";
            $colorMensaje="red";
        }
    }
}

//Modificar Usuario
$visibilidadCajaModificarUsuario="ocultar";
//Eliminar Usuario
$visibilidadCajaEliminarUsuario="ocultar";



// CAJA PASSWORD
$mensajeConsultaPassword="";
$dni = "";
$password="";


$errorPassword="";
$errorConfirmPassword="";
$errorDigitosPassword= "";
$cambioPasswordExitoso ="";
$mostrarCajaConsultaPassword="";


//Consultar Password
$visibilidadCajaConsultarPassword="ocultar";
$visibilidadBotonMasConsultarPassword="mostrar";
$visibilidadBotonMenosConsultarPassword="ocultar";
if(isset($_POST["consulta"])){
    $dni = $_POST["dniConsulta"]; 
    $visibilidadCajaConsultarPassword="mostrar";
    $visibilidadBotonMasConsultarPassword="ocultar";
    $visibilidadBotonMenosConsultarPassword="mostrar";        
    
    $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = '$dni'");
    $consulta1->execute();
    $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
    $seccion="secciones/password.php";
    if(empty($dniExiste)){
        $mensajeConsultaPassword= "El dni ingresado no está registrado";
        $colorMensaje="red";
    }else{        
        if(($dniExiste[0]["rol"])!="postulante"){
            $mensajeConsultaPassword = "Solo puede consultar la contraseña a usuarios con rol 'postulante'";
            $colorMensaje="red";
        }else{
            $password = $dniExiste[0]["password"]; 
            $mensajeConsultaPassword="La contraseña para el dni $dni es: $password";
            $colorMensaje="green";
        }
    }            
}

//Reset Password
$mensajeResetPassword="";
$visibilidadCajaResetPassword="ocultar";
$visibilidadBotonMasResetPassword="mostrar";
$visibilidadBotonMenosResetPassword="ocultar";
if(isset($_POST["reset"])){    
    $dni = $_POST["dniReset"];   
    $visibilidadCajaResetPassword="mostrar";
    $visibilidadBotonMasResetPassword="ocultar";
    $visibilidadBotonMenosResetPassword="mostrar"; 

    $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = '$dni'");
    $consulta1->execute();
    $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
    $seccion="secciones/password.php";

                  
    if(empty($dniExiste)){
        $mensajeResetPassword= "El dni ingresado no está registrado";
        $colorMensaje="red";
    } else{   
        if(($dniExiste[0]["rol"])!="postulante"){
            $mensajeResetPassword = "Solo puede resetearle la contraseña a usuarios con rol 'postulante'";
            $colorMensaje="red";
        }else{
            $password = rand(111111, 999999);
            $consulta2 = $baseDeDatos ->
                prepare("UPDATE usuarios SET password = '$password' WHERE dni = '$dni'");
            $consulta2->execute();
                            
            $mensajeResetPassword="Cambio Exitoso. La nueva contraseña para el usuario $dni es $password";
            $colorMensaje="green";
        }    
    }
}

//Cambiar Password
$visibilidadCajaCambiarPassword="ocultar";
$visibilidadBotonMasCambiarPassword="mostrar";
$visibilidadBotonMenosCambiarPassword="ocultar";
$mensajeCambiarPassword="";
if(isset($_POST["cambiarPassword"])){
    $dni=$_SESSION["dni"];
    $visibilidadCajaCambiarPassword="mostrar";
    $visibilidadBotonMasCambiarPassword="ocultar";
    $visibilidadBotonMenosCambiarPassword="mostrar"; 

    $consulta2 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = '$dni'");
    $consulta2->execute();
    $datosUsuarios =$consulta2 -> fetchAll(PDO::FETCH_ASSOC);
    $seccion="secciones/password.php";
    
    
    if(($_POST["oldPassword"])!= ($datosUsuarios[0]["password"])){
        $mensajeCambiarPassword="La contraseña actual ingresada no es la correcta";
        $colorMensaje="red";
    } 
    if(($_POST["newPassword"]) != ($_POST["confirmPassword"])){
        $mensajeCambiarPassword = "Las contraseñas ingresadas no coinciden";
        $colorMensaje="red";
    }
    if(strlen($_POST["newPassword"])!=6){
        $mensajeCambiarPassword = "La nueva contraseña debe poseer 6 digitos";
        $colorMensaje="red";
    }
    if ((($_POST["oldPassword"])== ($datosUsuarios[0]["password"])) 
        && (($_POST["newPassword"]) == ($_POST["confirmPassword"]))
        && (strlen($_POST["newPassword"])==6)){
            $dni = $_SESSION["dni"];
            $newPassword = $_POST["newPassword"];
            $consultaCambiarPassword =  $baseDeDatos -> prepare
            ("UPDATE usuarios SET password = '$newPassword' WHERE dni = '$dni'"); 
            $consultaCambiarPassword -> execute();

            $mensajeCambiarPassword ="El cambio de contraseña se realizó exitosamente";
            $colorMensaje="green";
    }
}



// CAJA TEST  

$mensajeHabilitarTest="";
$mensajeBloquearTest="";
$mensajeConsultarAvance="";

$visibilidadCajaHabilitarTest = "ocultar";
$visibilidadBotonMasHabilitarTest="mostrar";
$visibilidadBotonMenosHabilitarTest="ocultar";


//habilitar Test
if(isset($_POST["habilitarTest"])){
    
    $visibilidadCajaHabilitarTest="block"; 
    $visibilidadBotonMasHabilitarTest="ocultar";
    $visibilidadBotonMenosHabilitarTest="mostrar"; 
    $seccion="secciones/test.php";
    if($_POST["testAHabilitar"]=="none"){
        $mensajeHabilitarTest = "Debe seleccionar el test que desea habilitar";
    }else{
        if(empty($_POST["dniAHabilitar"])){
            $mensajeHabilitarTest="Debe ingresar un DNI";
        }else{
                $dni = $_POST["dniAHabilitar"];   

                $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                $consulta1->execute();
                $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);

                if(empty($dniExiste)){
                    $mensajeHabilitarTest= "El dni ingresado no está registrado";
                }else{
                    $testAHabilitar = $_POST["testAHabilitar"];
                    
                    if($testAHabilitar=="test1"){
                        if(empty($_POST["tiempoParaTest"])){
                            $tiempoDisponible=2700;
                        } else{
                            $tiempoDisponible=$_POST["tiempoParaTest"]*60;
                        }
                        $consulta = $baseDeDatos-> prepare
                            ("UPDATE usuarios SET $testAHabilitar = -2, nivelRaven=1, horaRaven='s/d',
                            tiempoRaven =$tiempoDisponible WHERE dni = '$dni'");
                        $consulta->execute();
                        $mensajeHabilitarTest="Se habilitó '$testAHabilitar' exitosamente para el usuario '$dni'";
                        
                    }else{
                        $consulta = $baseDeDatos-> prepare
                            ("UPDATE usuarios SET $testAHabilitar = -2 WHERE dni = '$dni'");
                        $consulta->execute();
                        $mensajeHabilitarTest="Se habilitó '$testAHabilitar' exitosamente para el usuario '$dni'";
                    } 
                }    
        }        
    }    
}  

//bloquear test
$visibilidadCajaBloquearTest = "ocultar";
$visibilidadBotonMasBloquearTest="mostrar";
$visibilidadBotonMenosBloquearTest="ocultar";
if(isset($_POST["bloquearTest"])){
    $visibilidadCajaBloquearTest="block"; 
    $visibilidadBotonMasBloquearTest="ocultar";
    $visibilidadBotonMenosBloquearTest="mostrar"; 
    $seccion="secciones/test.php";

    if($_POST["testABloquear"]=="none"){
        $mensajeBloquearTest = "Debe seleccionar el test que desea bloquear";
    }else{
        if(empty($_POST["dniABloquear"])){
            $mensajeBloquearTest="Debe ingresar un DNI";
        }else{
                $dni = $_POST["dniABloquear"];   

                $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
                $consulta1->execute();
                $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);

                if(empty($dniExiste)){
                    $mensajeBloquearTest= "El dni ingresado no está registrado";
                }else{
                    $testABloquear = $_POST["testABloquear"];
                    $consulta2 = $baseDeDatos ->
                            prepare("UPDATE usuarios SET $testABloquear = -1 WHERE dni = '$dni'");
                    $consulta2->execute();
                    $mensajeBloquearTest="Se ha bloqueado exitosamente $testABloquear para el usuario $dni";
                } 
        }        
    }        
}

//avance de test por usuario
$dniConsultaAvance = "";
$mostrarAvance="none";
$avanceRaven="";
$avanceArea2="";
$avanceArea3="";
$avanceArea6="";
$avanceArea8="";
$avanceArea9="";

$visibilidadCajaConsultarAvance = "ocultar";
$visibilidadBotonMasConsultarAvance="mostrar";
$visibilidadBotonMenosConsultarAvance="ocultar";

if(isset($_POST["avance"])){
    $visibilidadCajaConsultarAvance="block"; 
    $visibilidadBotonMasConsultarAvance="ocultar";
    $visibilidadBotonMenosConsultarAvance="mostrar"; 
    $seccion="secciones/test.php"; 
    if(empty($_POST["dniConsultaAvance"])){
        $mensajeConsultarAvance="Debe ingresar un DNI";
    }else{

            $dniConsultaAvance = $_POST["dniConsultaAvance"]; 
            $consulta1 = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = '$dniConsultaAvance'");
            $consulta1->execute();
            $dniExiste =$consulta1 -> fetchAll(PDO::FETCH_ASSOC);
            
            
            if(empty($dniExiste)){
                $mensajeConsultarAvance= "El dni ingresado no está registrado";
            }else{
                $mostrarAvance ="block";
                $raven =$dniExiste[0]["test1"];
                    if($raven == -2 ){
                        $avanceRaven = "Test Liberado";
                    }elseif($raven==-1){
                        $avanceRaven="Test Bloqueado";
                    }else{
                        $avanceRaven = "Test Realizado";
                    }
                                                           
                $area2 =$dniExiste[0]["area2"];
                    if($area2 == -2){
                        $avanceArea2 = "Test Liberado";
                    }elseif($area2 == -1){
                        $avanceArea2 = "Test Bloqueado";
                    }
                    else{
                        $avanceArea2="Test Realizado";
                    }

                $area3 =$dniExiste[0]["area3"];
                    if($area3 == -2){
                        $avanceArea3 = "Test Liberado";
                    }elseif($area3 == -1){
                        $avanceArea3 = "Test Bloqueado";
                    }else{
                        $avanceArea3="Test Realizado";
                    } 
                $area6 =$dniExiste[0]["area6"];
                    if($area6 == -2){
                        $avanceArea6 = "Test Liberado";
                    }elseif($area6 == -1){
                        $avanceArea6 = "Test Bloqueado";
                    }else{
                        $avanceArea6="Test Realizado";
                    }   

                $area8 =$dniExiste[0]["area8"];
                    if($area8 == -2){
                        $avanceArea8 = "Test Liberado";
                    }elseif($area8 == -1){
                        $avanceArea8 = "Test Bloqueado";
                    }else{    
                        $avanceArea8="Test Realizado";
                    }   

                $area9 =$dniExiste[0]["area9"];
                    if($area9== -2){
                        $avanceArea9 = "Test Liberado";
                    }elseif($area9 == -1){
                        $avanceArea9 = "Test bloqueado";
                    }else{    
                        $avanceArea9="Test realizado";
                    }      
            }
    }
}     




// consulta de resultados  //

$mostrarResultados="none";
$errorDniCajaResultados="";
$ocultar="block";
$correctasTest1="s/d";
$totalAreas="s/d";
$mostrarConsultaResultados="none";

  

if(isset($_POST["consultarDni"])){
            require("respuestasCorrectas.php");
            $zIndexResultados=2;
            $dniConsultaResultados = $_POST["dni"];
            if((is_numeric($dniConsultaResultados))!=true){
                $errorDniCajaResultados = "El valor ingresado debe ser numérico";
            }else{
                //verifico que el dni este registrado como usuario
                $consultaDni = $baseDeDatos-> prepare  ("SELECT * from usuarios WHERE dni ='$dniConsultaResultados'");
                $consultaDni->execute();
                $datosDni =$consultaDni -> fetchAll(PDO::FETCH_ASSOC);
                
                //si el dni ingresado no esta en bdd asigno error
                if(empty($datosDni)){
                    $errorDniCajaResultados ="El dni ingresado no está registrado como usuario";
                }
                //si el dni ingresado esta en bdd brindo los resultados
                else{
                    $mostrarConsultaResultados="block";
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
                                    from test1 WHERE dni = '$dniConsultaResultados'");
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
                                pregunta4, pregunta5, pregunta6, pregunta7, pregunta8 from area2 WHERE dni = '$dniConsultaResultados'");
                            $consultaArea2->execute();
                            $datosArea2 =$consultaArea2 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea2 = array_intersect_assoc($area2, $datosArea2[0]);
                            $correctasArea2 = count($comparacionArea2);

                            //calculo cantidad de respuestas correctas area3
                            $consultaArea3 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area3 WHERE dni = '$dniConsultaResultados'");
                            $consultaArea3->execute();
                            $datosArea3 =$consultaArea3 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea3 = array_intersect_assoc($area3, $datosArea3[0]);
                            $correctasArea3 = count($comparacionArea3);

                            //calculo cantidad de respuestas correctas area6
                            $consultaArea6 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area6 WHERE dni = '$dniConsultaResultados'");
                            $consultaArea6->execute();
                            $datosArea6 =$consultaArea6 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea6 = array_intersect_assoc($area6, $datosArea6[0]);
                            $correctasArea6 = count($comparacionArea6);
                            
                            //calculo cantidad de respuestas correctas area8
                            $consultaArea8 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area8 WHERE dni = '$dniConsultaResultados'");
                            $consultaArea8->execute();
                            $datosArea8 =$consultaArea8 -> fetchAll(PDO::FETCH_ASSOC);

                            $comparacionArea8 = array_intersect_assoc($area8, $datosArea8[0]);
                            $correctasArea8 = count($comparacionArea8);
                            

                            //calculo cantidad de respuestas correctas area9
                            $consultaArea9 = $baseDeDatos-> prepare  ("SELECT pregunta1, pregunta2, pregunta3,
                            pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, pregunta9, pregunta10 
                            from area9 WHERE dni = '$dniConsultaResultados'");
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



?>