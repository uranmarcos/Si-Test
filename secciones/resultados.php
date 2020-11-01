<!-- Resultados  -->
<div class="cajaInterna resultados">
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Consultar Resultados</h6>
            <button class="verMas <?php echo  $visibilidadBotonMasConsultarResultados?>" name="ConsultarResultados" id="verMasConsultarResultados"> Ver +</button>
            <button class="verMenos <?php echo  $visibilidadBotonMenosConsultarResultados?>" name="ConsultarResultados" id="verMenosConsultarResultados"> Ver -</button>                  
        </nav> 
        <div class="<?php echo $visibilidadCajaConsultarResultados?>" id="cajaConsultarResultados">    
            <form class="formulario" action="admin.php" method="POST" id="ConsultarResultados">   
                <div class="row rowForm">    
                    <label class="col-2 fwb">DNI</label>      
                    <input class="col-3 input" type="integer" autocomplete="off" name="dni" value="">   
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>
                    <input class="col-3 botonInput" type="submit" name="consultarDni" value="Consultar"> 
                </div> 
                <div class="rowForm red <?php echo $colorMensaje?>" id="mensajeConsultarResultados"> 
                     <?php echo $mensajeConsultarResultados?> 
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
                    <div>  
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
            </form>
        </div>    
    </article>
    