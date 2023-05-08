<?php
    require("../conexion/conexion.php");
    $user = new ApptivaDB();

    $accion = "mostrar";
    $res = array("error" => false);
    $archivoPdf = null;
    
    if (isset($_GET["accion"])) {
        $accion = $_GET["accion"];
    }


    switch ($accion) {
        case 'login':
            $usuario    = $_POST["usuario"];
            $password   = $_POST["password"];  
            $voluntario = $_POST["voluntario"];     
            if ($voluntario) {
                $u = $user -> loginVoluntario($usuario, $password);    
            } else {
                $u = $user -> loginPostulante($usuario, $password); 
            }

            if ($u || $u == []) { 
                if ( empty($u)) {
                    $res["u"] = $u;
                    $res["mensaje"] = "El usuario no se encuentra registrado.";
                    $res["error"] = true;
                } else{    
                    $res["u"] = $u;
                    $res["mensaje"] = "Login ok.";
                    $res["error"] = false;
                    $_SESSION["autenticado"] = "si";
                    $_SESSION["name"] = $u[0]["nombre"];
                    $_SESSION["rol"] = $u[0]["rol"];
                    $_SESSION["dni"] = $u[0]["dni"];
                    $_SESSION["idUsuario"] = $u[0]["id"];

                    if ($_SESSION["rol"]=="postulante") {
                        echo "<script>location.href='../menu.php';</script>";        
                    }else{
                        echo "<script>location.href='../adminr.php';</script>";
                        // header( 'Location: ../adminr.php' ) ;
                    }
                    // if (hash_equals($password, $u[0]["contra"])){
                    //     $res["u"] = $u;
                    //     $res["mensaje"] = "Login ok.";
                    //     $res["error"] = false;
                    // }else{
                    //     $res["u"] = $u;
                    //     $res["mensaje"] = "La contraseña ingresada es incorrecta.";
                    //     $res["error"] = true;
                    // }
                }  
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;


        case 'getUsuarios':
            $filtro = $_POST["filtro"];
            $buscador = $_POST["buscador"];
            $inicio = $_POST["inicio"];
         
            $u = $user -> consultarUsuarios($filtro, $buscador, $inicio);

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'getVoluntarios':
            $u = $user -> consultarVoluntarios();

            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["usuarios"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'crearUsuario':

            $provincia = $_POST["provincia"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST['dni'];
            $telefono = $_POST["telefono"];
            $rol = $_POST["rol"];
            $mail = $_POST['mail'];
            $asignado = $_POST['asignado'];
            $habilitado = 1;
            $contrasenia = null;
            $null = null;
            $anio = null;

            // VALIDO QUE EL DNI NO ESTE CARGADO YA EN SISTEMA
            $dataValidar = " dni LIKE '$dni'"; 
            $validacion = $user -> hayRegistro($dataValidar);  
                    
            if ($validacion > 0) {
                $res["mensaje"] = "El dni ya se encuentra registrado";
                $res["error"] = true; 
                break;
            }
            if ($validacion === false) {
                $res["mensaje"] = "La creación no pudo realizarse";
                $res["error"] = true;
                break;
            }

            // SI EL DNI NO ESTA CARGADO Y EL USUARIO NO ES POSTULANTE, VALIDO EL MAIL

            if ($rol != 'postulante') {
                $dataValidar = " mail LIKE '$mail'"; 
                $validacion = $user -> hayRegistro($dataValidar);  
                    
                if ($validacion > 0) {
                    $res["mensaje"] = "El mail ya se encuentra registrado";
                    $res["error"] = true; 
                    break;
                }
                if ($validacion === false) {
                    $res["mensaje"] = "La creación no pudo realizarse";
                    $res["error"] = true;
                    break;
                }
            }
                    

            if ($rol == "postulante") {
                $contrasenia = rand(100000, 999999);
                $anio = date("Y");
            } else {
                $contrasenia = password_hash($dni, PASSWORD_DEFAULT);
            }



            $data = "'" . $nombre . "', '" . $apellido . "', '" . $dni . "', '" . $contrasenia . "', '" . $mail . "', '" . $anio .
             "', '" . $habilitado . "', '" . $rol . "', '" . $provincia . "', '" . $null . "', '" . $null . "', '" . $telefono . "', '" . $asignado . "'";
            
            $u = $user -> insertarUsuario($data);
        
            if ($u) {
                $res["error"] = false;
                if ($rol == "postulante") {
                    $res["mensaje"] = "El usuario se creó correctamente. Se le asignó la contraseña " . $contrasenia;
                } else {
                    $res["mensaje"] = "El usuario se creó correctamente. Se le asignó como contraseña su dni";
                }
            } else {
                $res["mensaje"] = "No se pudo crear el usuario. Intente nuevamente";
                $res["error"] = true;
            } 

        break;

        case 'editarUsuario':
            $null = null;
            $id = $_POST['id'];
            $rol = $_POST["rol"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $mail = $_POST['mail'];
            $provincia = $_POST["provincia"];
            $telefono = $_POST["telefono"];

            // SI EL DNI NO ESTA CARGADO Y EL USUARIO NO ES POSTULANTE, VALIDO QUE EL MAIL NO ESTE ASIGNADO A OTRO USUARIO
            if ($rol != 'postulante') {
                $dataValidar = " mail LIKE '$mail' AND id <> '$id'"; 
                $validacion = $user -> validarMailExistente($dataValidar);  
                    
                if ($validacion > 0) {
                    $res["mensaje"] = "El mail ya se encuentra registrado";
                    $res["error"] = true; 
                    break;
                }
                if ($validacion === false) {
                    $res["mensaje"] = "La creación no pudo realizarse";
                    $res["error"] = true;
                    break;
                }
            }

            $data = "rol = '" . $rol . "', nombre = '" . $nombre . "', apellido = '" . $apellido . "', mail = '" . $mail . "', telefono = '" . $telefono . "', provincia = '" . $provincia . "'";;
            $u = $user -> editarUsuario($data, $id);  
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El usuario se editó correctamente.";
               
            } else {
                $res["mensaje"] = "No se pudo editar el usuario. Intente nuevamente";
                $res["error"] = true;
            } 

        break;

        case 'eliminarUsuario':
            $idUsuario = $_POST["idUsuario"];

            $u = $user -> eliminar("usuariosnuevos", "id = ". $idUsuario);
            if ($u || $u == []) { 
                $res["libros"] = $u;
                $res["mensaje"] = "El usuario se eliminó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo eliminar el usuario";
                $res["error"] = true;
            } 
        break;

        case 'asignarUsuario':
            $idUsuario = $_POST["idUsuario"];
            $idVoluntario = $_POST["idVoluntario"];

            $u = $user -> asignarUsuario($idUsuario, $idVoluntario);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El usuario se asignó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo asignar el usuario";
                $res["error"] = true;
            } 

        break;

        case 'habilitarUsuario':
            $id = $_POST["idUsuario"];
            $habilitado = $_POST["habilitado"];

            $u = $user -> habilitarUsuario($id, $habilitado);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                $res["mensaje"] = "El usuario se " . ($habilitado == 1 ? 'habilitó' : 'bloqueó') . " correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo " . $habilitado == 1 ? 'habilitar' : 'bloquear' . " el usuario";
                $res["error"] = true;
            } 
        break;

        case 'resetear':
            $id = $_POST["idUsuario"];
            $dni = $_POST["dni"];
            $rol = $_POST["rol"];
            $contrasenia = null;

            if ($rol == "postulante") {
                $contrasenia = rand(100000, 999999);
            } else {
                $contrasenia = password_hash($dni, PASSWORD_DEFAULT);
            }

            $u = $user -> resetear($id, $contrasenia);
            if ($u || $u == []) { 
                $res["usuarios"] = $u;
                if ($rol == "postulante") {
                    $res["mensaje"] = "El usuario se creó correctamente. Se le asignó la contraseña " . $contrasenia;
                } else {
                    $res["mensaje"] = "El usuario se creó correctamente. Se le asignó como contraseña su dni";
                }
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo resetear la contraseña";
                $res["error"] = true;
            } 
        break;

        case 'editarDni':
            $id = $_POST['id'];
            $dni = $_POST["dni"];

            // VALIDO QUE EL DNI NO ESTE CARGADO YA EN SISTEMA
            $dataValidar = " dni LIKE '$dni'"; 
            $validacion = $user -> hayRegistro($dataValidar);  
                    
            if ($validacion > 0) {
                $res["mensaje"] = "El dni ya se encuentra registrado";
                $res["error"] = true; 
                break;
            }
            if ($validacion === false) {
                $res["mensaje"] = "La creación no pudo realizarse";
                $res["error"] = true;
                break;
            }

            $u = $user -> editarDni($id, $dni);  
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El DNI se editó correctamente.";
               
            } else {
                $res["mensaje"] = "No se pudo editar el dni. Intente nuevamente";
                $res["error"] = true;
            } 

        break;























        case 'getCategorias':
            $tipo = $_POST["recurso"];
            $condicion = "tipo = '". $tipo . "'";
                   
            $u = $user -> consultarCategorias("categoriasrecursos", $condicion);

            if ($u || $u == []) { 
                $res["categorias"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo recuperar las categorias";
                $res["error"] = true;
            } 

        break;


   












        //////////////////////////////////////////















        case 'enviarPedido':
            require("pdf.php");
          
            $nombreSiPueden     = $_POST["nombreSiPueden"]; 
            $nombreVoluntario   = $_POST["nombreVoluntario"]; 
            $direccionEnvio     = $_POST["direccionEnvio"]; 
            $ciudad             = $_POST["ciudad"];  
            $provincia          = $_POST["provincia"]; 
            $codigoPostal       = $_POST["codigoPostal"];
            $telefono           = $_POST["telefono"];
            $fecha              = $_POST["fecha"];
            $mail               = $_POST["mail"];
            $mailCopia          = $_POST["mailCopia"];
            $pedido             = $_POST["pedido"];
            $pedidoTabla        = explode(';', $pedido);
            $otros              = $_POST["otros"];

            $pedidoBase = $pedido . ", otros : " . $otros;
            date_default_timezone_set('America/Argentina/Cordoba');
            $date = date("Y-m-d H:i:s");

            $data = "'" . $date . "', '" . $direccionEnvio . "', '" . $ciudad . "', '" . $provincia . "', '" . $codigoPostal . "', '" . $telefono . "', '" . $pedidoBase . "', '" . $nombreVoluntario . "', '" . $nombreSiPueden . "'";
            // local:
            // $u = $user -> insertar("pedidos", $data);
            // prod
            $u = $user -> insertar("sipueden", $data);
         
            if ($u == false) { 
                $res["mensaje"] = "El pedido no pudo realizarse";
                // $res["mensaje"] = $u;
                $res["error"] = true;
               
            } else {
                $otrosFormateado = ""; 
                if ($otros != null) {
                    $cantidadRenglones = ceil(strlen($otros) / 95);
                    for ($i = 0; $i < $cantidadRenglones; $i++) {
                        $inicial = 95 * $i;
                        $final = 95;
                        if($final > strlen($otros)){
                            $final = strlen($otros);
                        }
                        $string = substr($otros, $inicial, $final) . "\n";  
                        $otrosFormateado = $otrosFormateado . $string;
                    }
                }
    
    
                try {
                    $pdf = new PDF();
                    $pdf->AliasNbPages();
                    $header = array('Listado de articulos pedidos');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(0,10,$fecha,0,1,'R');
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(0,5,"Nuevo pedido de " . utf8_decode($nombreSiPueden),0,1,'C');
                    
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Datos de envio: ',0,1, 'L', true);
                    // $pdf->Cell(0,10,'Datos de envio: ',0,1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(0,10, utf8_decode("Voluntario: ") . utf8_decode($nombreVoluntario), 0,1);
                    $pdf->Cell(0,10, utf8_decode("Dirección: ") . utf8_decode($direccionEnvio) . ", " . utf8_decode($ciudad) . ", " . utf8_decode($provincia), 0,1);
                   
                    $pdf->Cell(0,10, utf8_decode('Código postal: ') . utf8_decode($codigoPostal),0,1);
                    $pdf->Cell(0,10, utf8_decode('Teléfono: ') . utf8_decode($telefono),0,1);
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Articulos pedidos: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->TablaSimple($header, $pedidoTabla);
    
                    foreach ($pedidoTabla as $key => $value) {
                        $pdf->SetFont('Arial','',10);
                        $pdf->Cell(0,10, utf8_decode($value),1,1);
                    }
                    
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    if($otrosFormateado != '' && $otrosFormateado != null) {
                        $pdf->Cell(0,10,'Otros: ',0,1);
                        $pdf->SetFont('Arial','',10);
                        $pdf->Multicell(190,10,utf8_decode($otrosFormateado),1);
                    }

                    $archivoPdf = $pdf->Output('','S');                  
    
                    $email_user = "pedidosresidencias@hotmail.com";
                    $email_password = "pedidos.1379";
    
                    $the_subject = "Nuevo pedido de " . utf8_decode($nombreSiPueden);
                    $address_to = $mail;
                    $from_name = "Si Pueden";
                    $phpmailer = new PHPMailer();
                    // ———- datos de la cuenta de Gmail ——————————-
                    $phpmailer->Username = $email_user;
                    $phpmailer->Password = $email_password; 
                    
                    $phpmailer->Host = "smtp.office365.com"; // GMail
                    $phpmailer->SMTPSecure = 'STARTTLS';
                    
                    $phpmailer->Port = 587;
                    $phpmailer->IsSMTP(); // use SMTP
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->setFrom($phpmailer->Username,$from_name);
                    $phpmailer->AddAddress($address_to); // recipients email
                    if ($mailCopia) {
                        $phpmailer->AddBCC($mail);
                        $address_to = $mailCopia;
                    }
                    $phpmailer->Subject = $the_subject;	
    
                    $phpmailer->Body .="<p>Nuevo pedido de </p>" . utf8_decode($nombreSiPueden) . " - ";
                    $phpmailer->Body .= utf8_decode($ciudad) . ", " . utf8_decode($provincia);
                    $phpmailer->Body .= "<p>Fecha: " . $fecha ."</p>";
                    $phpmailer->IsHTML(true);
                    $phpmailer->AddStringAttachment($archivoPdf, utf8_decode($nombreSiPueden) . '.pdf','base64');
                    try {
                        $phpmailer->smtpConnect([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]);
                        $mensaje = "Pedido enviado correctamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = false;
                    } catch (\Throwable $th) {
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                    if(!$phpmailer->send()) { 
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                } catch (\Throwable $th) {
                    $mensaje = "Hubo un error al enviar el pedido. Intente nuevamente";
                    $res["mensaje"] = $mensaje;
                    $res["error"] = true;
                }
            }

        break;

        case 'enviarPedidoLibros':
            require("pdf.php");
          
            $nombreSiPueden     = $_POST["nombreSiPueden"]; 
            $nombreVoluntario   = $_POST["nombreVoluntario"]; 
            $direccionEnvio     = $_POST["direccionEnvio"]; 
            $ciudad             = $_POST["ciudad"];  
            $provincia          = $_POST["provincia"]; 
            $codigoPostal       = $_POST["codigoPostal"];
            $telefono           = $_POST["telefono"];
            $fecha              = $_POST["fecha"];
            $mail               = $_POST["mail"];
            $mailCopia          = $_POST["mailCopia"];
            $pedido             = $_POST["pedido"];
            $pedidoTabla        = explode(';', $pedido);
            $pedidoVacio        = [];

            date_default_timezone_set('America/Argentina/Cordoba');
            $date = date("Y-m-d H:i:s");

            $data = "'" . $date . "', '" . $direccionEnvio . "', '" . $ciudad . "', '" . $provincia . "', '" . $codigoPostal . "', '" . $telefono . "', '" . $pedido . "', '" . $nombreVoluntario . "', '" . $nombreSiPueden . "'";
            // local:
            // $u = $user -> insertar("pedidos", $data);
            // prod
            $u = $user -> insertar("sipueden", $data);
         
            if ($u == false) { 
                $res["mensaje"] = "El pedido no pudo realizarse";
                $res["error"] = true;
                          
            } else {   
    
                try {
                    $pdf = new PDF();
                    $pdf->AliasNbPages();
                    $header = array('Listado de libros pedidos');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(0,10,$fecha,0,1,'R');
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(0,5,"Nuevo pedido de " . utf8_decode($nombreSiPueden),0,1,'C');
                    
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Datos de envio: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(0,10, utf8_decode("Voluntario: ") . utf8_decode($nombreVoluntario), 0,1);
                    $pdf->Cell(0,10, utf8_decode("Dirección: ") . utf8_decode($direccionEnvio) . ", " . utf8_decode($ciudad) . ", " . utf8_decode($provincia), 0,1);
                   
                    $pdf->Cell(0,10, utf8_decode('Código postal: ') . utf8_decode($codigoPostal),0,1);
                    $pdf->Cell(0,10, utf8_decode('Teléfono: ') . utf8_decode($telefono),0,1);
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Libros pedidos: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->TablaSimple($header, $pedidoVacio);
    
                    foreach ($pedidoTabla as $key => $value) {
                        $pdf->SetFont('Arial','',10);
                        $pdf->Cell(0,10, utf8_decode($value),1,1);
                    }
                    
                    $pdf->Ln();

                    $archivoPdf = $pdf->Output('','S');                  
    
                    $email_user = "pedidosresidencias@hotmail.com";
                    $email_password = "pedidos.1379";
    
                    $the_subject = "Nuevo pedido de " . utf8_decode($nombreSiPueden);
                    $address_to = $mail;
                    $from_name = "Si Pueden";
                    $phpmailer = new PHPMailer();
                    // ———- datos de la cuenta de Gmail ——————————-
                    $phpmailer->Username = $email_user;
                    $phpmailer->Password = $email_password; 
                    
                    $phpmailer->Host = "smtp.office365.com"; // GMail
                    $phpmailer->SMTPSecure = 'STARTTLS';
                    
                    $phpmailer->Port = 587;
                    $phpmailer->IsSMTP(); // use SMTP
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->setFrom($phpmailer->Username,$from_name);
                    $phpmailer->AddAddress($address_to); // recipients email
                    if ($mailCopia) {
                        $phpmailer->AddBCC($mail);
                        $address_to = $mailCopia;
                    }
                    $phpmailer->Subject = $the_subject;	
    
                    $phpmailer->Body .="<p>Nuevo pedido de </p>" . utf8_decode($nombreSiPueden) . " - ";
                    $phpmailer->Body .= utf8_decode($ciudad) . ", " . utf8_decode($provincia);
                    $phpmailer->Body .= "<p>Fecha: " . $fecha ."</p>";
                    $phpmailer->IsHTML(true);
                    $phpmailer->AddStringAttachment($archivoPdf, utf8_decode($nombreSiPueden) . '.pdf','base64');
                    try {
                        $phpmailer->smtpConnect([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]);
                        $mensaje = "Pedido enviado correctamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = false;
                    } catch (\Throwable $th) {
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                    if(!$phpmailer->send()) { 
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                } catch (\Throwable $th) {
                    $mensaje = "Hubo un error al enviar el pedido. Intente nuevamente";
                    $res["mensaje"] = $mensaje;
                    $res["error"] = true;
                }
            }

        break;

        case 'enviarPedidoMeriendas':
            require("pdf.php");
          
            $nombreSiPueden     = $_POST["nombreSiPueden"]; 
            $nombreVoluntario   = $_POST["nombreVoluntario"]; 
            $direccionEnvio     = $_POST["direccionEnvio"]; 
            $ciudad             = $_POST["ciudad"];  
            $provincia          = $_POST["provincia"]; 
            $codigoPostal       = $_POST["codigoPostal"];
            $telefono           = $_POST["telefono"];
            $fecha              = $_POST["fecha"];
            $mail               = $_POST["mail"];
            $mailCopia          = $_POST["mailCopia"];
            $pedido             = $_POST["pedido"];
            $pedidoTabla        = explode(';', $pedido);
            $pedidoVacio        = [];

            date_default_timezone_set('America/Argentina/Cordoba');
            $date = date("Y-m-d H:i:s");

            $data = "'" . $date . "', '" . $direccionEnvio . "', '" . $ciudad . "', '" . $provincia . "', '" . $codigoPostal . "', '" . $telefono . "', '" . $pedido . "', '" . $nombreVoluntario . "', '" . $nombreSiPueden . "'";
            // local:
            // $u = $user -> insertar("pedidos", $data);
            // prod
            $u = $user -> insertar("sipueden", $data);
         
            if ($u == false) { 
                $res["mensaje"] = "El pedido no pudo realizarse";
                $res["error"] = true;
                          
            } else {   
    
                try {
                    $pdf = new PDF();
                    $pdf->AliasNbPages();
                    $header = array('Listado de articulos pedidos');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(0,10,$fecha,0,1,'R');
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(0,5,"Nuevo pedido de " . utf8_decode($nombreSiPueden),0,1,'C');
                    
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Datos de envio: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(0,10, utf8_decode("Voluntario: ") . utf8_decode($nombreVoluntario), 0,1);
                    $pdf->Cell(0,10, utf8_decode("Dirección: ") . utf8_decode($direccionEnvio) . ", " . utf8_decode($ciudad) . ", " . utf8_decode($provincia), 0,1);
                   
                    $pdf->Cell(0,10, utf8_decode('Código postal: ') . utf8_decode($codigoPostal),0,1);
                    $pdf->Cell(0,10, utf8_decode('Teléfono: ') . utf8_decode($telefono),0,1);
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Articulos pedidos: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->TablaSimple($header, $pedidoVacio);
    
                    foreach ($pedidoTabla as $key => $value) {
                        $pdf->SetFont('Arial','',10);
                        $pdf->Cell(0,10, utf8_decode($value),1,1);
                    }
                    
                    $pdf->Ln();

                    $archivoPdf = $pdf->Output('','S');                  
    
                    $email_user = "pedidosresidencias@hotmail.com";
                    $email_password = "pedidos.1379";
    
                    $the_subject = "Nuevo pedido de " . utf8_decode($nombreSiPueden);
                    $address_to = $mail;
                    $from_name = "Si Pueden";
                    $phpmailer = new PHPMailer();
                    // ———- datos de la cuenta de Gmail ——————————-
                    $phpmailer->Username = $email_user;
                    $phpmailer->Password = $email_password; 
                    
                    $phpmailer->Host = "smtp.office365.com"; // GMail
                    $phpmailer->SMTPSecure = 'STARTTLS';
                    
                    $phpmailer->Port = 587;
                    $phpmailer->IsSMTP(); // use SMTP
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->setFrom($phpmailer->Username,$from_name);
                    $phpmailer->AddAddress($address_to); // recipients email
                    if ($mailCopia) {
                        $phpmailer->AddBCC($mail);
                        $address_to = $mailCopia;
                    }
                    $phpmailer->Subject = $the_subject;	
    
                    $phpmailer->Body .="<p>Nuevo pedido de </p>" . utf8_decode($nombreSiPueden) . " - ";
                    $phpmailer->Body .= utf8_decode($ciudad) . ", " . utf8_decode($provincia);
                    $phpmailer->Body .= "<p>Fecha: " . $fecha ."</p>";
                    $phpmailer->IsHTML(true);
                    $phpmailer->AddStringAttachment($archivoPdf, utf8_decode($nombreSiPueden) . '.pdf','base64');
                    try {
                        $phpmailer->smtpConnect([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]);
                        $mensaje = "Pedido enviado correctamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = false;
                    } catch (\Throwable $th) {
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                    if(!$phpmailer->send()) { 
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                } catch (\Throwable $th) {
                    $mensaje = "Hubo un error al enviar el pedido. Intente nuevamente";
                    $res["mensaje"] = $mensaje;
                    $res["error"] = true;
                }
            }

        break;

        case 'enviarPedidoRecursos':
            require("pdf.php");
          
            $nombreSiPueden     = $_POST["nombreSiPueden"]; 
            $nombreVoluntario   = $_POST["nombreVoluntario"]; 
            $direccionEnvio     = $_POST["direccionEnvio"]; 
            $ciudad             = $_POST["ciudad"];  
            $provincia          = $_POST["provincia"]; 
            $codigoPostal       = $_POST["codigoPostal"];
            $telefono           = $_POST["telefono"];
            $fecha              = $_POST["fecha"];
            $mail               = $_POST["mail"];
            $mailCopia          = $_POST["mailCopia"];
            $pedido             = $_POST["pedido"];
            $pedidoTabla        = explode(';', $pedido);
            $pedidoVacio        = [];

            date_default_timezone_set('America/Argentina/Cordoba');
            $date = date("Y-m-d H:i:s");

            $data = "'" . $date . "', '" . $direccionEnvio . "', '" . $ciudad . "', '" . $provincia . "', '" . $codigoPostal . "', '" . $telefono . "', '" . $pedido . "', '" . $nombreVoluntario . "', '" . $nombreSiPueden . "'";
            // local:
            // $u = $user -> insertar("pedidos", $data);
            // prod
            $u = $user -> insertar("sipueden", $data);
         
            if ($u == false) { 
                $res["mensaje"] = "El pedido no pudo realizarse";
                $res["error"] = true;
                          
            } else {   
    
                try {
                    $pdf = new PDF();
                    $pdf->AliasNbPages();
                    $header = array('Listado de recursos pedidos');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(0,10,$fecha,0,1,'R');
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(0,5,"Nuevo pedido de " . utf8_decode($nombreSiPueden),0,1,'C');
                    
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Datos de envio: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(0,10, utf8_decode("Voluntario: ") . utf8_decode($nombreVoluntario), 0,1);
                    $pdf->Cell(0,10, utf8_decode("Dirección: ") . utf8_decode($direccionEnvio) . ", " . utf8_decode($ciudad) . ", " . utf8_decode($provincia), 0,1);
                   
                    $pdf->Cell(0,10, utf8_decode('Código postal: ') . utf8_decode($codigoPostal),0,1);
                    $pdf->Cell(0,10, utf8_decode('Teléfono: ') . utf8_decode($telefono),0,1);
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell(0,10,'Recursos pedidos: ',0,1, 'L', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->TablaSimple($header, $pedidoVacio);
    
                    foreach ($pedidoTabla as $key => $value) {
                        $pdf->SetFont('Arial','',10);
                        $pdf->Cell(0,10, utf8_decode($value),1,1);
                    }
                    
                    $pdf->Ln();

                    $archivoPdf = $pdf->Output('','S');                  
    
                    $email_user = "pedidosresidencias@hotmail.com";
                    $email_password = "pedidos.1379";
    
                    $the_subject = "Nuevo pedido de " . utf8_decode($nombreSiPueden);
                    $address_to = $mail;
                    $from_name = "Si Pueden";
                    $phpmailer = new PHPMailer();
                    // ———- datos de la cuenta de Gmail ——————————-
                    $phpmailer->Username = $email_user;
                    $phpmailer->Password = $email_password; 
                    
                    $phpmailer->Host = "smtp.office365.com"; // GMail
                    $phpmailer->SMTPSecure = 'STARTTLS';
                    
                    $phpmailer->Port = 587;
                    $phpmailer->IsSMTP(); // use SMTP
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->setFrom($phpmailer->Username,$from_name);
                    $phpmailer->AddAddress($address_to); // recipients email
                    if ($mailCopia) {
                        $phpmailer->AddBCC($mail);
                        $address_to = $mailCopia;
                    }
                    $phpmailer->Subject = $the_subject;	
    
                    $phpmailer->Body .="<p>Nuevo pedido de </p>" . utf8_decode($nombreSiPueden) . " - ";
                    $phpmailer->Body .= utf8_decode($ciudad) . ", " . utf8_decode($provincia);
                    $phpmailer->Body .= "<p>Fecha: " . $fecha ."</p>";
                    $phpmailer->IsHTML(true);
                    $phpmailer->AddStringAttachment($archivoPdf, utf8_decode($nombreSiPueden) . '.pdf','base64');
                    try {
                        $phpmailer->smtpConnect([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]);
                        $mensaje = "Pedido enviado correctamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = false;
                    } catch (\Throwable $th) {
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                    if(!$phpmailer->send()) { 
                        $mensaje = "El pedido no se pudo enviar. Intente nuevamente";
                        $res["mensaje"] = $mensaje;
                        $res["error"] = true;
                        die;
                    }
                } catch (\Throwable $th) {
                    $mensaje = "Hubo un error al enviar el pedido. Intente nuevamente";
                    $res["mensaje"] = $mensaje;
                    $res["error"] = true;
                }
            }

        break;

        case 'getRecursos':
            $tipo = $_POST["recurso"];
            $idCategoria = $_POST["idCategoria"];
            $inicio = $_POST["inicio"];
            $condicion = "tipo = '". $tipo . "'";

            $u = $user -> consultar("recursos", $tipo, $idCategoria, $inicio);

            if ($u || $u == []) { 
                $res["archivos"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'getLibros':
            $tipo = $_POST["recurso"];
            $idCategoria = $_POST["idCategoria"];
            $buscador = $_POST["buscador"];
            $inicio = $_POST["inicio"];
            $condicion = "tipo = '". $tipo . "'";
            
            $u = $user -> consultarLibros("recursos", $tipo, $idCategoria, $buscador, $inicio);



            if ($u || $u == []) { 
                $res["archivos"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'getPlanificaciones':
            $idCategoria = $_POST["idCategoria"];
            $inicio = $_POST["inicio"];

            $u = $user -> consultarPlanificaciones("recursos", $idCategoria, $inicio);

            if ($u || $u == []) { 
                $res["archivos"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'verPlanificacion':
            $id = $_POST["idPlanificacion"];
            $condicion = "id = '". $id . "'";

            $u = $user -> verPlanificacion("recursos", $condicion);

            if ($u || $u == []) { 
                $res["archivos"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Por favor recargue la página.";
                $res["error"] = true;
            } 

        break;

        case 'getCategorias':
            $tipo = $_POST["recurso"];
            $condicion = "tipo = '". $tipo . "'";
                   
            $u = $user -> consultarCategorias("categoriasrecursos", $condicion);

            if ($u || $u == []) { 
                $res["categorias"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo recuperar las categorias";
                $res["error"] = true;
            } 

        break;

        case 'contarLibros':
            $categoria = $_POST["categoria"];
            $buscador = $_POST["buscador"];

            $u = $user -> contarLibros($categoria, $buscador);
            if ($u || $u == []) { 
                $res["cantidad"] = $u[0]["total"];
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
            } 

        break;

        case 'contarRecursos':
            $categoria = $_POST["categoria"];

            $u = $user -> contarRecursos($categoria);
            if ($u || $u == []) { 
                $res["cantidad"] = $u[0]["total"];
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
            } 

        break;

        case 'contarPlanificaciones':
            $categoria = $_POST["categoria"];

            $u = $user -> contarPlanificaciones($categoria);
            if ($u || $u == []) { 
                $res["cantidad"] = $u[0]["total"];
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "Hubo un error al recuperar la información. Actualice la página";
                $res["error"] = true;
            } 

        break;


        case 'postCategoria':
            $tipo = $_POST["tipo"];
            $categoria = $_POST["categoria"];

            $data = "'" . $tipo  ."', '" . $categoria  . "'";
            $u = $user -> insertar("categoriasrecursos", $data);

            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "La categoria se creó correctamente";
            } else {
                $res["mensaje"] = "No se pudo crear la categoria";
                $res["error"] = true;
            } 

        break;

        case 'crearRecurso':
            $tipo = $_POST["tipo"];
            $nombre = $_POST["nombre"];
            $categoria = $_POST["categoria"];
            $descripcion = $_POST["descripcion"];
            $archivo = $_POST['archivo'];
            $data = "'" . $tipo . "', '" . $nombre . "', '" . $categoria . "', '" . $descripcion . "', '" . $archivo . "'";
            
            $u = $user -> insertar("recursos", $data);
            //echo $u;
        
            if ($u) {
                $res["error"] = false;
                $res["mensaje"] = "El archivo se guardó correctamente";
            } else {
                $res["mensaje"] = "No se pudo guardar el archivo. Intente nuevamente";
                $res["error"] = true;
            } 

        break;

        case 'buscarLibrosPorCategoria':
            $idCategoria = $_POST["idCategoria"];

            $u = $user -> buscarPorCategoria($idCategoria);
            if ($u || $u == []) { 
                $res["libros"] = $u;
                $res["mensaje"] = "La consulta se realizó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo recuperar los pedidos";
                $res["error"] = true;
            } 

        break;


        case 'eliminarLibro':
            $idLibro = $_POST["idLibro"];

            $u = $user -> eliminar("recursos", "id = ". $idLibro);
            if ($u || $u == []) { 
                $res["libros"] = $u;
                $res["mensaje"] = "El libro se eliminó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo eliminar el libro";
                $res["error"] = true;
            } 

        break;

        case 'eliminarRecurso':
            $idRecurso = $_POST["idRecurso"];

            $u = $user -> eliminar("recursos", "id = ". $idRecurso);
            if ($u || $u == []) { 
                $res["recursos"] = $u;
                $res["mensaje"] = "El recurso se eliminó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo eliminar el recurso";
                $res["error"] = true;
            } 

        break;

        case 'eliminarPlanificacion':
            $idRecurso = $_POST["idPlanificacion"];

            $u = $user -> eliminar("recursos", "id = ". $idRecurso);
            if ($u || $u == []) { 
                $res["recursos"] = $u;
                $res["mensaje"] = "La planificación se eliminó correctamente";
            } else {
                $res["u"] = $u;
                $res["mensaje"] = "No se pudo eliminar la planificación";
                $res["error"] = true;
            } 

        break;

        default:
            # code...
            break;
    }


    echo json_encode($res);
?>