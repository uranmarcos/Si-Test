<?php

  $dsn = "mysql:dbname=fundaci_postulaciones; host=localhost; port=21";
  $usuario = "fundaci_postulaciones";
  $pass = "Resi.124689";

  try {
    $baseDeDatos = new PDO($dsn, $usuario, $pass);
    $baseDeDatos -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (\Exception $e) {
      echo "Oh no, hubo un error! Vuelves mas tarde?"; exit;
  }