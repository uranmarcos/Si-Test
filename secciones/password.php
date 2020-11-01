<!-- Contraseñas -->
<div class="cajaInterna password" style="z-index : <?php echo $zIndexPassword?>">
    <!-- Consultar Password-->   
    <article> 
        <nav class="justify-content-between">
            <h6 class="nameArticle">Consultar Contraseña</h6>
            <button class="verMas <?php echo $visibilidadBotonMasConsultarPassword?>" name="ConsultaPassword" id="verMasConsultaPassword"> Ver +</buton>
            <button class="verMenos <?php echo $visibilidadBotonMenosConsultarPassword?>" name="ConsultaPassword" id="verMenosConsultaPassword"> Ver -</button>
        </nav>
        <div class="<?php echo $visibilidadCajaConsultarPassword?>" id="cajaConsultaPassword">
           <form class="formulario" action="admin.php" id="ConsultarPassword" method="POST">                    
                <div class="row rowForm">        
                    <label class="col-2 fwb">DNI</label>
                    <input class="col-3 input" type="text" name="dni" autocomplete="off" value="">    
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>
                    <input class="col-3 botonInput" type="submit" name="consulta" value="Consultar">
                </div>
                <div class="rowForm red <?php echo $colorMensaje?>" id="mensajeConsultarPassword">
                    <?php echo $mensajeConsultaPassword ?>
                </div>      
            </form>
        </div>            
    </article>
    <!-- Reset Password -->     
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Resetear Contraseña</h6>
            <button class="verMas <?php echo $visibilidadBotonMasResetPassword?>" name="ResetPassword" id="verMasResetPassword"> Ver +</button>
            <button class="verMenos <?php echo $visibilidadBotonMenosResetPassword?>" name="ResetPassword" id="verMenosResetPassword"> Ver -</button>
        </nav> 
        <div class="<?php echo $visibilidadCajaResetPassword?>" id="cajaResetPassword">
            <div class="row rowForm">
                <p>
                    Esta opción generará una contraseña de 6 dígitos aleatorios para el usuario ingresado. 
                    <br>
                    Solo podrá resetearle la contraseña a usuarios con rol "postulante"
                </p>
            </div>    
            <form class="formulario" action="admin.php" id="ResetPassword" method="POST">
                <div class="row rowForm">        
                    <label class="col-2 fwb">DNI</label>
                    <input class="col-3 input" type="text" name="dni" autocomplete="off" value="">    
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>
                    <input class="col-3 botonInput" type="submit" name="reset" value="Resetear"> 
                </div>
                <div class="rowForm red <?php echo $colorMensaje?>" id="mensajeResetPassword">
                    <?php echo $mensajeResetPassword ?>
                </div>    
            </form>
        </div>            
    </article>
    <!-- Cambiar Password-->     
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Cambiar Contraseña</h6>
            <button class="verMas <?php echo $visibilidadBotonMasCambiarPassword?>" name="CambiarPassword" id="verMasCambiarPassword"> Ver +</button>
            <button class="verMenos <?php echo $visibilidadBotonMenosCambiarPassword?>" name="CambiarPassword" id="verMenosCambiarPassword"> Ver -</button>
        </nav> 
        <div class="<?php echo $visibilidadCajaCambiarPassword?>" id="cajaCambiarPassword">
            <div class="row rowForm">
                <p>
                    Esta opción permite modificar la contraseña por la que usted elija (debe poseer seis dígitos).
                    <br>
                    Solo podrá modificar su contraseña.
                </p>
            </div>                   
            <form class="formulario" action="admin.php" method="POST" id="CambiarPassword">                        
                <div class="row rowForm">        
                    <label class="col-4 fwb leftTexto">Contraseña Actual</label>
                    <input class="col-4 input" type="text" name="password" autocomplete="off" value="">
                    <div class="offset-2"></div>                                           
                </div>
                <div class="row rowForm"> 
                    <label class="col-4 fwb leftTexto">Nueva Contraseña</label>
                    <input class="col-4 input" type="text" name="password" autocomplete="off" value="">
                    <div class="offset-2"></div>
                </div>
                <div class="row rowForm">     
                    <label class="col-4 fwb leftTexto">Confirme Nueva Contraseña</label>    
                    <input class="col-4 input" type="text" name="confirmPassword" autocomplete="off" value="">
                    <div class="offset-2"></div>
                </div>
                <div class="row rowForm"> 
                    <div class="offset-2"></div>
                    <div class="offset-3"></div>
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>
                    <input class="col-3 botonInput" type="submit" name="cambiarPassword" value="Cambiar"> 
                </div>
                <div class="rowForm red <?php echo $colorMensaje?>" id="mensajeCambiarPassword">
                    <?php echo $mensajeCambiarPassword ?>
                </div>    
            </form>
        </div>     
    </article>    
    