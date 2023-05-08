<?php
session_start();
require("pdo.php");
$errorLogin="";
$errorUsuario ="";
$dni=0;
$password=0;


if($_POST){
    $dni = $_POST["dni"];
    $password = $_POST["password"];
        

    $consulta = $baseDeDatos ->prepare("SELECT * FROM usuarios WHERE dni = $dni");
    $consulta->execute();
    $datosUsuarios =$consulta -> fetchAll(PDO::FETCH_ASSOC);

    if(empty($datosUsuarios)){
        $errorUsuario = "El DNI ingresado no está registrado";
    } else{    
            if($password == $datosUsuarios[0]["password"]){
                $_SESSION["autenticado"] = "si";
                $_SESSION["name"] = $datosUsuarios[0]["nombre"];
                $_SESSION["rol"] = $datosUsuarios[0]["rol"];
                $_SESSION["dni"] = $datosUsuarios[0]["dni"];

                    if($_SESSION["rol"]=="postulante"){
                        echo "<script>location.href='menu.php';</script>";        
                    }else{
                        echo "<script>location.href='admin.php';</script>";
                    }
            }else{
                $errorLogin="Los datos ingresados son erróneos";
            }
    }        
}
