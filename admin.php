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
    <link href="css/adminStyles.css" rel="stylesheet">
    
  </head>
  <body class="container">
        <header class="row fwb  header justify-content-between align-items-center">
                    <h4 class="col-4 leftTexto">¡Hola <?php echo $_SESSION["name"]?>!</h4>
                    <a class="col-4 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
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
                                        <input class="cajaBoton <?php echo $bgUsuarios?>" type="submit" name="usuarios" value="Usuarios">
                                    </div> 
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton <?php echo $bgPassword?>" type="submit" name="password" value="Contraseñas">                           
                                    </div>    
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton <?php echo $bgTest?>" type="submit" name="test" value="Test">         
                                    </div> 
                                    <div class="botonMenuAdmin">
                                        <input class="cajaBoton <?php echo $bgResultados?>" type="submit" name="resultados" value="Resultados">           
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
                        <!-- Crear Usuario -->    
                        <article>    
                            <div class="row anchoRow justify-content-between headerArticle">   
                                <h6 class="fwb purple">Crear usuario</h6> 
                                <button class="verMas <?php echo  $visibilidadBotonMasCrearUsuario?>" name="CrearUsuario" id="verMasCrearUsuario"> Ver +</button>
                                <button class="verMenos <?php echo  $visibilidadBotonMenosCrearUsuario?>" name="CrearUsuario" id="verMenosCrearUsuario"> Ver -</button>  
                            </div>
                            <div class="<?php echo $visibilidadCajaCrearUsuario?>" id="cajaCrearUsuario">    
                                <div class="row respuestaAConsulta">
                                    <p>
                                        Si al usuario se le asigna rol: "postulante" se le generará una clave aleatoria de 6 dígitos.
                                        <br>
                                        <br>
                                        Si al usuario se le asigna rol: "voluntario" se le generará una clave igual a los últimos 6 dígitos de su DNI.<br> El usuario podrá
                                        luego modificarla en la opcion "Contraseñas" del menú principal.
                                    </p>
                                </div>        
                                <form class="formulario" action="admin.php" method="POST">
                                    <div class="row  respuestaAConsulta justify-content-between" >
                                        <label class="col-2 fwb">Nombre:</label>  
                                        <input class="col-3" type="text" required name="name" autocomplete="off" value="">    
                                        <div class="offset-2"></div>
                                        <label class="col-2 fwb">Apellido:</label>    
                                        <input class="col-3" type="text" required autocomplete="off" name="lastName" value="">
                                    </div>    
                                    <div class="row  respuestaAConsulta justify-content-between" >
                                        <label class="col-2 fwb">DNI:</label>
                                        <input class="col-3" type="int" required autocomplete="off" name="dni" value=""> 
                                        <div class="offset-2"></div>    
                                        <label class="col-2 fwb">Rol</label>    
                                        <select class="col-3" name="rol">Rol:
                                                <option value="postulante">Postulante</option>
                                                <option value="voluntario">Voluntario</option>
                                        </select>   
                                    </div>  
                                    <div class="row  respuestaAConsulta justify-content-between" >
                                        <label class="col-2 fwb">Email:</label>
                                        <input class="col-3" type="text" autocomplete="off" name="email" placeholder="Solo rol voluntario" value=""> 
                                        <div class="offset-2"></div>
                                        <div class="offset-2"></div> 
                                        <input  type="submit" class="col-3 botonInput" name="crearUsuario" value="crear">
                                    </div>

                                    <div class="respuestaAConsulta fwb <?php echo $colorMensaje?>">
                                            <?php echo $mensajeUsuarios?> 
                                    </div> 
                                   
                                
                                </form> 
                            </div>
                        </article>     
                        <!-- Modificar Usuario -->
                        <article>    
                            <div class="row anchoRow justify-content-between headerArticle">   
                                <h6 class="fwb purple">Modificar usuario</h6> 
                                <button class="verMas" name="ModificarUsuario" id="verMasModificarUsuario"> Ver +</button>
                                <button class="verMenos ocultar" name="ModificarUsuario" id="verMenosModificarUsuario"> Ver -</button>  
                            </div>
                            <div class="<?php echo $visibilidadCajaModificarUsuario?>" id="cajaModificarUsuario">    
                                <div class="row respuestaAConsulta">
                                    <p>   
                                        Opción no disponible aún.
                                    </p>
                                </div>
                            </div>
                        </article>  
                        <!-- Eliminar Usuario -->
                        <article>    
                            <div class="row anchoRow justify-content-between headerArticle">   
                                <h6 class="fwb purple">Eliminar usuario</h6> 
                                <button class="verMas" name="EliminarUsuario" id="verMasEliminarUsuario"> Ver +</button>
                                <button class="verMenos ocultar" name="EliminarUsuario" id="verMenosEliminarUsuario"> Ver -</button>  
                            </div>
                            <div class="<?php echo $visibilidadCajaEliminarUsuario?>" id="cajaEliminarUsuario">    
                                <div class="row respuestaAConsulta">
                                    <p>   
                                        Opción no disponible aún.
                                    </p>
                                </div>
                            </div>
                        </article>  
                    </div>         

                    <!-- Contraseñas -->
                    <div class="cajaInterna password" style="z-index : <?php echo $zIndexPassword?>">
                        <!-- Consultar Password-->   
                        <article> 
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Consultar Contraseña</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasConsultarPassword?>" name="ConsultaPassword" id="verMasConsultaPassword"> Ver +</buton>
                                <button class="verMenos <?php echo $visibilidadBotonMenosConsultarPassword?>" name="ConsultaPassword" id="verMenosConsultaPassword"> Ver -</button>
                            </div>
                            <form class="formulario" action="admin.php" method="POST">                    
                                <div id="cajaConsultaPassword" class="<?php echo $visibilidadCajaConsultarPassword?>">
                                    <div class="row respuestaAConsulta justify-content-around">        
                                        <label class="col-2 fwb centrarTexto">DNI</label>
                                            <input class="col-3" type="text" name="dniConsulta" autocomplete="off" value="">    
                                            <div class="offset-2"></div>
                                            <div class="offset-2"></div>
                                            <input class="col-3 botonInput" type="submit" name="consulta" value="Consultar">
                                    </div>
                                    <div class="row respuestaAConsulta">  
                                        <p class="<?php echo $colorMensaje?> fwb">
                                            <?php echo $mensajeConsultaPassword ?>
                                        </p>
                                    </div>      
                                </div>
                            </form>        
                        </article>
                        <!-- Reset Password -->     
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Resetear Contraseña</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasResetPassword?>" name="ResetPassword" id="verMasResetPassword"> Ver +</button>
                                <button class="verMenos <?php echo $visibilidadBotonMenosResetPassword?>" name="ResetPassword" id="verMenosResetPassword"> Ver -</button>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">
                                <div id="cajaResetPassword" class="<?php echo $visibilidadCajaResetPassword?>">
                                    <div class="row respuestaAConsulta">
                                        <p>
                                            Esta opción generará una contraseña de 6 dígitos aleatorios para el usuario ingresado. 
                                            <br>
                                            Solo podrá resetearle la contraseña a usuarios con rol "postulante"
                                        </p>
                                    </div>    
                                    <div class="row respuestaAConsulta justify-content-around">        
                                        <label class="col-2 fwb centrarTexto">DNI</label>
                                            <input class="col-3" type="text" name="dniReset" autocomplete="off" value="">    
                                            <div class="offset-2"></div>
                                            <div class="offset-2"></div>
                                            <input class="col-3 botonInput" type="submit" name="reset" value="Resetear"> 
                                    </div>
                                    <div class="row respuestaAConsulta">
                                        <p class="<?php echo $colorMensaje?>">
                                            <?php echo $mensajeResetPassword ?>
                                        </p>
                                    </div>    
                                </div>
                            </form>            
                        </article>
                        <!-- Cambiar Password-->     
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Cambiar Contraseña</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasCambiarPassword?>" name="CambiarPassword" id="verMasCambiarPassword"> Ver +</button>
                                <button class="verMenos <?php echo $visibilidadBotonMenosCambiarPassword?>" name="CambiarPassword" id="verMenosCambiarPassword"> Ver -</button>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">                        
                                <div id="cajaCambiarPassword" class="<?php echo $visibilidadCajaCambiarPassword?>">
                                    <div class="row respuestaAConsulta ">
                                        <p>
                                            Esta opción permite modificar la contraseña por la que usted elija (debe poseer seis dígitos).
                                            <br>
                                            Solo podrá modificar su contraseña.
                                        </p>
                                    </div>    
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
                                    <div class="row respuestaAConsulta justify-content-around"> 
                                        <div class="offset-2"></div>
                                        <div class="offset-3"></div>
                                        <div class="offset-2"></div>
                                        <div class="offset-2"></div>
                                        <input class="col-3 botonInput" type="submit" name="cambiarPassword" value="Cambiar"> 
                                    </div>
                                    <div class="row respuestaAConsulta">
                                        <p class="<?php echo $colorMensaje?>">
                                            <?php echo $mensajeCambiarPassword ?>
                                        </p>
                                    </div>    
                                </div> 
                            </form>
                        </article>    
                    </div>
                    
                    <!-- Test  -->
                    <div class="cajaInterna test" style="z-index:<?php echo $zIndexTest?>">
                        <!--  Habilitar Test -->
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Habilitar Test</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasHabilitarTest?>" name="HabilitarTest" id="verMasHabilitarTest"> Ver +</button>
                                <button class="verMenos <?php echo $visibilidadBotonMenosHabilitarTest?>" name="HabilitarTest" id="verMenosHabilitarTest"> Ver -</button>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">
                                <div id="cajaHabilitarTest" class="<?php echo $visibilidadCajaHabilitarTest?>">    
                                    <div class="row respuestaAConsulta">
                                        <p>Al hacerlo, se borrarán los resultados que el usuario haya obtenido en el mismo. <br> 
                                            Si habilita Raven, podrá ingresar el tiempo que desea brindarle al usuario. En caso de no ingresar ningún valor
                                            se le asignarán 45 minutos para la realización del test.
                                        </p>                        
                                    </div>    
                                    <div class="row  respuestaAConsulta justify-content-between" >    
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
                                    <div class="row  respuestaAConsulta justify-content-between" >   
                                        <label class="col-1 fwb">Minutos:</label>  
                                        <input class="col-2" type="number" name="tiempoParaTest" autocomplete="off" value="minutos Raven">  
                                        <div class="offset-2"></div>
                                        <div class="offset-2"></div>
                                        <input class="col-2 botonInput" type="submit" name="habilitarTest" value="Habilitar">
                                    </div>
                                    <div class="row respuestaAConsulta">   
                                        <p class="red">
                                            <?php echo $errorDniCajaHabilitarTest?>
                                            <?php echo $errorTestCajaHabilitarTest?>
                                        </p>
                                        <p class="green">
                                            <?php echo $testHabilitado ?>  
                                        </p>
                                    </div>   
                                </div> 
                            </form>    
                        </article>            
                        <!-- Bloquear Test -->
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Bloquear Test</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasBloquearTest?>" name="BloquearTest" id="verMasBloquearTest"> Ver +</button>
                                <button class="verMenos <?php echo $visibilidadBotonMenosBloquearTest?>" name="BloquearTest" id="verMenosBloquearTest"> Ver -</button>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">
                                <div id="cajaBloquearTest" class="<?php echo $visibilidadCajaBloquearTest?>"> 
                                    <div class="row respuestaAConsulta">
                                        <p>Al hacerlo, se le inhabilitará el botón del mismo al usuario seleccionado.</p>                          
                                    </div>
                                    <div class="row anchoRow respuestaAConsulta justify-content-between">        
                                        <label class="col-1 fwb">DNI:</label>
                                        <input class="col-2" type="text"  name="dniABloquear" autocomplete="off" value="">    
                                        <label class="col-2 fwb">Test:</label>
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
                                    <div class="row respuestaAConsulta">
                                        <p class="red">
                                            <?php echo $errorDniCajaBloquearTest ?>
                                            <?php echo $errorTestCajaBloquearTest ?>
                                        </p>
                                        <p class="green">
                                            <?php echo $testBloqueado ?>  
                                        </p>
                                    </div>    
                                </div>
                            </form>                                  
                        </article> 
                        <!-- consultar avance por usuario-->
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Consultar avance por usuario</h6>
                                <button class="verMas <?php echo $visibilidadBotonMasConsultarAvance?>" name="ConsultarAvance" id="verMasConsultarAvance"> Ver +</button>
                                <button class="verMenos <?php echo $visibilidadBotonMenosConsultarAvance?>" name="ConsultarAvance" id="verMenosConsultarAvance"> Ver -</button>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">     
                                <div id="cajaConsultarAvance" class="<?php echo $visibilidadCajaConsultarAvance?>">
                                    <div class="row anchoRow respuestaAConsulta justify-content-between">        
                                        <label class="col-1 centrarTexto fwb">DNI:</label>
                                        <input class="col-2" type="text"  name="dniConsultaAvance" autocomplete="off" value="">
                                        <div class="offset-2"> </div>
                                        <div class="offset-2"> </div>    
                                        <input class="col-2 botonInput" type="submit" name="avance" value="Consultar">
                                    </div>  
                                    <div class="row respuestaAConsulta">   
                                        <p class="red">
                                            <?php echo $errorDniCajaAvanceTest ?>
                                        </p> 
                                    </div>  
                                    <!-- resultados sobre la consulta del avance del postulante -->
                                    <div style="display: <?php echo $mostrarAvance?>">
                                        <div class="respuestaAConsulta">
                                            <strong>DNI: <?php echo $dniConsultaAvance?> </strong> 
                                        </div>
                                        <div class="row anchoRow respuestaAConsulta prueba justify-content-between">    
                                            <div class="col-4">
                                                <div>
                                                    <em>Raven:</em> <?php echo $avanceRaven?>
                                                </div>
                                                <div>
                                                    <em>Área 2:</em> <?php echo $avanceArea2?>
                                                </div> 
                                            </div>     
                                            <div class="col-4">
                                                <div>
                                                    <em>Área 3:</em> <?php echo $avanceArea3?>
                                                </div>
                                                <div>
                                                    <em>Área 6:</em> <?php echo $avanceArea6?>
                                                </div>
                                            </div>    
                                            <div class="col-4">
                                                <div>
                                                    <em>Área 8:</em> <?php echo $avanceArea8?>
                                                </div>
                                                <div>
                                                    <em>Área 9:</em> <?php echo $avanceArea9?>
                                                </div>
                                            </div>          
                                        </div> 
                                    </div>
                                </div>     
                            </form>   
                        </article>    
                    </div>

                    <!-- Resultados  -->
                    <div class="cajaInterna resultados" style="z-index : <?php echo $zIndexResultados?>">
                        <article>
                            <div class="row anchoRow justify-content-between headerArticle">
                                <h6 class="fwb purple">Consultar Resultados</h6>
                            </div> 
                            <form class="formulario" action="admin.php" method="POST">   
                                <div class="row  respuestaAConsulta justify-content-between" >    
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
                            </form>
                        </article>
                    </div>
                </main>                           
        </div>         
        
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app1.js"></script>
  </body>
</html>