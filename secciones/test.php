<div class="cajaInterna test" style="z-index:<?php echo $zIndexTest?>">
<!--  Habilitar Test -->
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Habilitar Test</h6>
            <button class="verMas <?php echo $visibilidadBotonMasHabilitarTest?>" name="HabilitarTest" id="verMasHabilitarTest"> Ver +</button>
            <button class="verMenos <?php echo $visibilidadBotonMenosHabilitarTest?>" name="HabilitarTest" id="verMenosHabilitarTest"> Ver -</button>
        </nav>
        <div class="<?php echo $visibilidadCajaHabilitarTest?>" id="cajaHabilitarTest">     
            <div class="row rowForm">
                <p> 
                    Al hacerlo, se borrarán los resultados que el usuario haya obtenido en el mismo. <br> 
                    Si habilita Raven, podrá ingresar el tiempo que desea brindarle al usuario. En caso de no ingresar ningún valor
                    se le asignarán 45 minutos para la realización del test.
                </p>                        
            </div>  
            <form class="formulario" action="admin.php" id="HabilitarTest" method="POST">
                <div class="row rowForm" >    
                    <label class="col-2 fwb">DNI:</label> 
                    <input class="col-3 input" type="text" name="dni" autocomplete="off" value=""> 
                    <div class="offset-1"></div>
                    <label class="col-2 fwb">Test:</label> 
                    <select class="col-3" name="testAHabilitar">Test
                        <option value="none"></option>
                        <option value="test1">Raven</option>
                        <option value="areas">Áreas</option>
                        <option value="area2">Área 2</option>
                        <option value="area3">Área 3</option>
                        <option value="area6">Área 6</option>
                        <option value="area8">Área 8</option>
                        <option value="area9">Área 9</option>
                    </select> 
                </div>        
                <div class="row  rowForm" >   
                    <label class="col-2 fwb">Minutos:</label>  
                    <input class="col-3 input" type="number" name="minutos" autocomplete="off" value="minutos Raven">  
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>
                    <input class="col-3 botonInput" type="submit" name="habilitarTest" value="Habilitar">
                </div>
                <div class="rowForm <?php echo $colorMensaje?>" id="mensajeHabilitarTest">  
                    <?php echo $mensajeHabilitarTest?>
                </div>   
            </form>
        </div>         
    </article>            
<!-- Bloquear Test -->
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Bloquear Test</h6>
            <button class="verMas <?php echo $visibilidadBotonMasBloquearTest?>" name="BloquearTest" id="verMasBloquearTest"> Ver +</button>
            <button class="verMenos <?php echo $visibilidadBotonMenosBloquearTest?>" name="BloquearTest" id="verMenosBloquearTest"> Ver -</button>
        </nav> 
        <div class="<?php echo $visibilidadCajaBloquearTest?>"  id="cajaBloquearTest"> 
            <div class="row rowForm">
                <p>
                    Al hacerlo, se le inhabilitará el botón del mismo al usuario seleccionado.
                </p>                          
            </div>
            <form class="formulario" action="admin.php" method="POST" id="BloquearTest">
                <div class="row rowForm">        
                    <label class="col-2 fwb">DNI:</label>
                    <input class="col-3 input" type="text"  name="dni" autocomplete="off" value="">    
                    <div class="offset-1"></div>
                    <label class="col-2 fwb">Test:</label>
                    <select class="col-3" name="testABloquear">Test
                        <option value="none"></option>
                        <option value="test1">Raven</option>
                        <option value="areas">Áreas</option>
                        <option value="area2">Área 2</option>
                        <option value="area3">Área 3</option>
                        <option value="area6">Área 6</option>
                        <option value="area8">Área 8</option>
                        <option value="area9">Área 9</option>
                    </select> 
                </div>
                <div class="row rowForm">
                    <div class="offset-2"></div>
                    <div class="offset-3"></div>
                    <div class="offset-1"></div>
                    <div class="offset-2"></div>    
                    <input class="col-3 botonInput" type="submit" name="bloquearTest" value="Bloquear">
                </div>
                <div class="rowForm <?php echo $colorMensaje?>" id="mensajeBloquearTest"> 
                    <?php echo $mensajeBloquearTest ?>
                </div>    
            </form>
        </div>                                      
    </article>
<!-- consultar avance por usuario-->
    <article>
        <nav class="justify-content-between">
            <h6 class="nameArticle">Consultar avance</h6>
            <button class="verMas <?php echo $visibilidadBotonMasConsultarAvance?>" name="ConsultarAvance" id="verMasConsultarAvance"> Ver +</button>
            <button class="verMenos <?php echo $visibilidadBotonMenosConsultarAvance?>" name="ConsultarAvance" id="verMenosConsultarAvance"> Ver -</button>
        </nav> 
        <div  class="<?php echo $visibilidadCajaConsultarAvance?>" id="cajaConsultarAvance">
            <form class="formulario" action="admin.php" method="POST" id="ConsultarAvance">     
                <div class="row rowForm">        
                    <label class="col-2 fwb">DNI:</label>
                    <input class="col-3 input" type="text"  name="dni" autocomplete="off" value="">
                    <div class="offset-1"> </div>
                    <div class="offset-2"> </div>    
                    <input class="col-3 botonInput" type="submit" name="avance" value="Consultar">
                </div>  
                <div class="rowForm <?php echo $colorMensaje?>" id="mensajeConsultarAvance">
                    <?php echo $mensajeConsultarAvance?>
                </div>  
                <!-- resultados sobre la consulta del avance del postulante -->
                <div style="display: <?php echo $mostrarAvance?>">
                    <div class="rowForm">
                        <strong>DNI: <?php echo $dniConsultaAvance?> </strong> 
                    </div>
                    <div class="row rowForm justify-content-between">    
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
            </form>
        </div>        
    </article>    
