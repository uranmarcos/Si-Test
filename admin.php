<?php
session_start();
require("pdo.php");
require("funcionesAdmin.php");


$rol=$_SESSION["rol"];
if(($_SESSION['autenticado']!="si") || ($rol !="voluntario")){
    echo "<script>location.href='index.php';</script>";
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sí</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/adminStyles1.css" rel="stylesheet">
    
  </head>
  <body class="container">
        <header class="row fwb purple header align-items-center">
                    <h4 class="col-6 centrarTexto">¡Hola <?php echo $_SESSION["name"]?>!</h4>
                    <a class="col-6 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
        </header>  
        <div class="row justify-content-center cajaPrincipal">
                <aside class="col-10 aside col-md-3">
                        <form class="row " action="admin.php" method="GET">
                                <div class="col-12 cajaMenu align-items-center">
                                    <div class="botonMenuAdmin">
                                        <a href="empezarTest.php" class="cajaBoton">Raven</a>
                                    </div>
                                    <div class="botonMenuAdmin">
                                        <a href="area2.php" class="cajaBoton">Área 2</a>
                                    </div>
                                    <div class="botonMenuAdmin">
                                        <a href="area3.php" class="cajaBoton">Área 3</a>
                                    </div>
                                    <div class="botonMenuAdmin">
                                        <a href="area6.php" class="cajaBoton">Área 6</a>
                                    </div>
                                    <div class="botonMenuAdmin">
                                        <a href="area8.php" class="cajaBoton">Área 8</a>
                                    </div>    
                                    <div class="botonMenuAdmin">
                                        <a href="area9.php" class="cajaBoton">Área 9</a>
                                    </div>
                                                                 
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton" name="usuarios" type="submit" value="Usuarios">
                                    </div> 
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton" name="password" type="submit" value="Contraseñas">                           
                                    </div>    
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton" name="test" type="submit" value="Test">         
                                    </div> 
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton"  name="resultados" type="submit" value="Resultados">           
                                    </div> 
                                    <div class="botonMenuAdmin" type="submit">
                                        <buton class="cajaBoton">Estadísticas
                                        </button>           
                                    </div> 
                                    <div class="botonMenuAdmin" type="submit">
                                        <buton class="cajaBoton">Ayuda
                                        </button>           
                                    </div> 
                                  
                                </div> 
                        </form>
                  
                </aside>
                <main class="col-10 col-md-9">        
                    <!--caja log -->
                    <div class="cajaInterna logo" style="z-index:<?php echo $zIndexLogo?>">
                        
                    </div>  

                    <!-- Usuarios -->
                    <div class="cajaInterna usuarios" style="z-index : <?php echo $zIndexUsuarios?>">
                            <h6 class="fwb purple">Crear un nuevo Usuario</h5>
                            <p>
                                Si al usuario se le asigna rol: "postulante" se le generará una clave aleatoria de 6 dígitos.
                                <br>
                                <br>
                                Si al usuario se le asigna rol: "voluntario" se le generará una clave igual a los últimos 6 dígitos de su DNI.<br> El usuario podrá
                                luego modificarla en la opcion "Contraseñas" del menú principal.
                            </p>    
                            <form class="formulario" action="admin.php" method="POST">
                                <div class="row justify-content-center">        
                                        <div class="col-10 col-md-3">    
                                            <label class="fwb">Nombre</label>
                                            <br>
                                            <input type="text" required name="name" autocomplete="off" value="">    
                                        </div>
                                        <div class="col-10 col-md-3"> 
                                            <label class="fwb">Apellido</label>
                                            <br>
                                            <input type="text" required autocomplete="off" name="lastName" value="">
                                        </div>
                                        <div class="col-10 col-md-3">  
                                            <label class="fwb">DNI</label>
                                            <br>
                                            <input type="int" required autocomplete="off" name="dni" value="">   
                                        </div>   
                                        
                                        <div class="col-10 col-md-3">
                                            <label class="fwb">Rol</label>
                                            <br>
                                            <select name="rol">Rol
                                                <option value="postulante">Postulante</option>
                                                <option value="voluntario">Voluntario</option>
                                            </select>           
                                        </div>
                                </div>  
                                <br>      
                                <div class="red centrarTexto">
                                        <?php echo $errorDni?> 
                                </div> 
                                <p class="centrarTexto"> <?php echo $usuarioCreado; ?></p>
                                
                                <div class="row justify-content-center">
                                        <input type="submit" class="botonInput" name="crear" value="crear">
                                </div>
                            </form> 
                    </div>

                    <!-- Contraseñas -->
                    <div class="cajaInterna password" style="z-index : <?php echo $zIndexPassword?>">
                            <form class="formulario" action="admin.php" method="POST">
                                <article>    
                                        <h6 class="fwb purple">Consultar Contraseña</h6>
                                        <div class="row justify-content-around">        
                                            <label class="col-1 fwb centrarTexto">DNI</label>
                                            <input class="col-2" type="text" name="dniConsulta" autocomplete="off" value="">    
                                            <div class="offset-2"></div>
                                            <div class="offset-2"></div>
                                            <input class="col-2 botonInput" type="submit" name="consulta" value="Consultar">
                                        </div>
                                        <p class="red">
                                            <?php echo $errorDniConsulta ?>
                                        </p>
                                        <p>    
                                            <?php echo $consulta ?>
                                        </p>    
                                </article>
                                <article>
                                        <h6 class="fwb purple">Resetear Contraseña</h6>
                                        <p>Esta opción generará una contraseña de 6 dígitos aleatorios para el usuario ingresado. 
                                            <br>
                                            Solo podrá resetearle la contraseña a usuarios con rol "postulante"
                                        </p>
                                        <div class="row justify-content-around">        
                                            <label class="col-1 fwb centrarTexto">DNI</label>
                                            <input class="col-2" type="text" name="dniReset" autocomplete="off" value="">    
                                            <div class="offset-2"></div>
                                            <div class="offset-2"></div>
                                            <input class="col-2 botonInput" type="submit" name="reset" value="Resetear"> 
                                        </div>
                                        <p class="red">
                                            <?php echo $errorDniReset ?>
                                        </p>
                                        <p>
                                            <?php echo $reset ?>    
                                        </p>
                                </article>
                                <article>
                                        <h6 class="fwb purple">Cambiar Contraseña</h6>
                                        <p>
                                            Esta opción permite modificar la contraseña por la que usted elija (debe poseer seis dígitos).
                                            <br>
                                            Solo podrá modificar su contraseña.
                                        </p>
                                        <div class="row justify-content-around">        
                                            <label class="col-4 fwb leftTexto">Contraseña Actual</label>
                                            <input class="col-4 " type="text" name="oldPassword" autocomplete="off" value="">
                                            <div class="offset-2"></div>                                           
                                        </div>
                                        <div class="row justify-content-around"> 
                                            <label class="col-4 fwb leftTexto">Nueva Contraseña</label>
                                            <input class="col-4" type="text" name="newPassword" autocomplete="off" value="">
                                            <div class="offset-2"></div>
                                        </div>
                                        <div class="row justify-content-around">     
                                            <label class="col-4 fwb leftTexto">Confirme Nueva Contraseña</label>    
                                            <input class="col-4" type="text" name="confirmPassword" autocomplete="off" value="">
                                            <div class="offset-2"></div>
                                        </div>
                                   
                                        <div class="row justify-content-around"> 
                                            <div class="offset-1">
                                            </div>
                                            <div class="offset-2">
                                            </div>
                                            <div class="offset-2">
                                            </div>
                                            <div class="offset-2">
                                            </div>
                                            <input class="col-2 botonInput" type="submit" name="cambiarPassword" value="Cambiar"> 
                                        </div>
                                        <p class="red">
                                            <?php echo $errorPassword ?>
                                            <br>
                                            <?php echo $errorConfirmPassword?>
                                            <br>
                                            <?php echo $errorDigitosPassword ?>
                                            <?php echo $cambioPasswordExitoso ?>
                                        </p>
                                        <p>
                                            <?php echo $reset ?>    
                                        </p>
                                </article>    
                            </form>  
                    </div>
                    
                    <!-- Test  -->
                    <div class="cajaInterna test" style="z-index:<?php echo $zIndexTest?>">
                            <form class="formulario" action="admin.php" method="POST">
                                <!--  Habilitar Test -->
                                <article>
                                    <h6 class="fwb purple">Habilitar Test</h6>
                                    <div>
                                        <p>Al hacerlo, se borrarán los resultados que el usuario haya obtenido en el mismo. <br> 
                                        Si habilita Raven, podrá ingresar el tiempo que desea brindarle al usuario. En caso de no ingresar ningún valor
                                        se le asignarán 45 minutos para la realización del test.</p>                        
                                        <div class="row anchoRow justify-content-between" >    
                                                <label class="col-1 fwb">DNI:</label> 
                                                <input class="col-2" type="text" name="dniAHabilitar" autocomplete="off" value=""> 
                                                <label class="col-2 fwb">Test:</label> 
                                                <select class="col-2" name="testAHabilitar">Test
                                                            <option value="none"></option>
                                                            <option value="test1">Raven</option>
                                                            <option value="areas">Áreas</option>
                                                            <option value="area2">Área 2</option>
                                                            <option value="area3">Área 3</option>
                                                            <option value="area6">Área 6</option>
                                                            <option value="area8">Área 8</option>
                                                            <option value="area9">Área 9</option>
                                                </select> 
                                                <div class="offset-2"></div>
                                        </div>        
                                        <div class="row anchoRow justify-content-between" >   
                                                <label class="col-1 fwb">Minutos:</label>  
                                                <input class="col-2" type="number" name="tiempoParaTest" autocomplete="off" value="minutos Raven">  
                                                <div class="offset-2"></div>
                                                <div class="offset-2"></div>
                                                <input class="col-2 botonInput" type="submit" name="habilitarTest" value="Habilitar">
                                                
                                        </div>
                                    </div>    
                                    <p class="red">
                                            <?php echo $errorDniCajaHabilitarTest?>
                                            <?php echo $errorTestCajaHabilitarTest?>
                                            <?php echo $testHabilitado ?>
                                    </p>  
                                        
                                </article>            
                                <!-- Bloquear Test -->
                                <article>
                                    <h6 class="fwb purple">Bloquear Test</h6>
                                    <div>
                                            <p>Al hacerlo, se le inhabilitará el botón del mismo al usuario seleccionado.</p>                          
                                            <div class="row anchoRow justify-content-between">        
                                                    <label class="col-1 fwb">DNI:</label>
                                                   
                                                    <input class="col-2" type="text"  name="dniABloquear" autocomplete="off" value="">    
                                                    <div class="col-2 fwb">Test:</div>
                                                    <select class="col-2" name="testABloquear">Test
                                                                <option value="none"></option>
                                                                <option value="test1">Raven</option>
                                                                <option value="areas">Áreas</option>
                                                                <option value="area2">Área 2</option>
                                                                <option value="area3">Área 3</option>
                                                                <option value="area6">Área 6</option>
                                                                <option value="area8">Área 8</option>
                                                                <option value="area9">Área 9</option>
                                                    </select> 
                                                    <input class="col-2 botonInput" type="submit" name="bloquearTest" value="Bloquear">
                                            </div>
                                    </div>    
                                    <p class="red">
                                            <?php echo $errorDniCajaBloquearTest ?>
                                            <?php echo $errorTestCajaBloquearTest ?>
                                            <?php echo $testBloqueado ?>
                                    </p>  
                                        
                                </article> 
                                <!-- consultar avance por usuario-->
                                <article>
                                    <h6 class="fwb purple">Consultar avance por usuario</h6>
                                    <div class="row anchoRow justify-content-between">        
                                        <label class="col-1 centrarTexto fwb">DNI:</label>
                                        <input class="col-2" type="text"  name="dniConsultaAvance" autocomplete="off" value="">
                                        <div class="offset-2"> </div>
                                        <div class="offset-2"> </div>    
                                        <input class="col-2 botonInput" type="submit" name="avance" value="Consultar">
                                    </div>  
                                    <p class="red">
                                        <?php echo $errorDniCajaAvanceTest ?>
                                    </p> 
                                    <!-- resultados sobre la consulta del avance del postulante -->
                                    <div style="display: <?php echo $mostrarAvance?>">
                                        <div class="centrarTexto">
                                                <strong>DNI: <?php echo $dniConsultaAvance?> </strong> 
                                        </div>
                                        <div class="row justify-content-around">    
                                            <div class="col-3">
                                                <div>
                                                    Raven: <?php echo $avanceRaven?>
                                                </div>
                                                <div>
                                                    Área 2: <?php echo $avanceArea2?>
                                                </div> 
                                            </div>     
                                            <div class="col-3">
                                                <div>
                                                    Área 3: <?php echo $avanceArea3?>
                                                </div>
                                                <div>
                                                    Área 6: <?php echo $avanceArea6?>
                                                </div>
                                            </div>    
                                            <div class="col-3">
                                                <div>
                                                    Área 8: <?php echo $avanceArea8?>
                                                </div>
                                                <div>
                                                    Área 9: <?php echo $avanceArea9?>
                                                </div>
                                            </div>          
                                            
                                        </div> 
                                    </div>           
                                </article>    
                                
                            </form>   
                    </div>

                    <!-- Resultados  -->
                    <div class="cajaInterna resultados" style="z-index : <?php echo $zIndexResultados?>">
                        <form class="formulario" action="admin.php" method="POST">    
                            <article>
                                <h6 class="fwb purple">Consultar Resultados</h6>
                                <div class="row anchoRow justify-content-around">  
                                    <div class="col-1">
                                        <strong>DNI</strong>
                                    </div>      
                                    <input class="col-2" type="integer" autocomplete="off" name="dni" value="">   
                                    <div class="offset-2"></div>
                                    <div class="offset-2"></div>
                                    <input class="col-2 botonInput" type="submit" name="consultarDni" value="Consultar"> 
                                </div> 
                              
                                
                                <div class="red"> 
                                        <?php echo $errorDniCajaResultados?> 
                                </div>    
                                                
                        </form> 
                        <div style="display:<?php echo $mostrarConsultaResultados?>">
                                <br>
                                <div class="row fwb purple centrarTexto justify-content-around">
                                        <div class="col-2">
                                            Nombre
                                        </div> 
                                        <div class="col-2">
                                            Apellido
                                        </div>
                                        <div class="col-2">
                                            DNI
                                        </div> 
                                        <div class="col-2">
                                            Raven
                                        </div> 
                                        <div class="col-2">
                                            Texto
                                        </div> 
                                </div>  
                                <br>
                                <div class="row purple centrarTexto justify-content-around">
                                        <div class="col-2">
                                            <?php echo $nombre?>
                                        </div> 
                                        <div class="col-2">
                                            <?php echo $apellido?>
                                        </div>
                                        <div class="col-2">
                                            <?php echo $dni2?>
                                        </div> 
                                        <div class="col-2">
                                            <?php echo $correctasTest1?>
                                        </div> 
                                        <div class="col-2">
                                            <?php echo $totalAreas?>
                                        </div> 
                                </div>  
                                <br>  
                                <p style="font-size:11px" class="red">
                                    <strong>s/d:</strong> El usuario aún no ingresó al test.
                                    <br>
                                    Test Liberado. 
                                    <br>
                                    <br>                                
                                    <strong>s/t:</strong> El usuario ingresó al test y salió del mismo sin terminarlo. 
                                        En Raven se habrán guardado las respuestas que haya seleccionado antes de salir, en CT no.
                                        <br>Test Bloqueado.
                                                                
                                </p>                         
                        </div>


                    </div>

                </main>                           
                   
        </div>         
        
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>