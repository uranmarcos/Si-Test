<?php
require("pdo.php");
$errorDni="";
$dniExistente=false;
$usuarioCreado="";
$password=0;


if($_POST){
        $nombre= $_POST["name"];
        $apellido = $_POST["lastName"];
        $dni = $_POST["dni"];
        $rol = $_POST["rol"];
    
    if (strlen($dni)!=8){
        $errorDni= "El dni ingresado debe poseer 8 dígitos";
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

                $usuarioCreado="Se ha creado exitosamente el siguiente usuario:  $nombre - $apellido - dni: $dni - clave: $password";
            }else{
            $errorDni="El dni ya está registrado";
        }
}
}

