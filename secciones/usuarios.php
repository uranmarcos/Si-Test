<div class="cajaInterna usuarios">
    <!-- Crear Usuario -->    
    <article>    
        <nav class="justify-content-between">   
            <h6 class="nameArticle">Crear usuario</h6> 
            <button class="verMas <?php echo  $visibilidadBotonMasCrearUsuario?>" name="CrearUsuario" id="verMasCrearUsuario"> Ver +</button>
            <button class="verMenos <?php echo  $visibilidadBotonMenosCrearUsuario?>" name="CrearUsuario" id="verMenosCrearUsuario"> Ver -</button>  
        </nav>
        <div class="<?php echo $visibilidadCajaCrearUsuario?>" id="cajaCrearUsuario">    
            <div class="rowForm">
                <p>
                    Si al usuario se le asigna rol: "postulante" se le generará una clave aleatoria de 6 dígitos.
                    <br>
                    <br>
                    Si al usuario se le asigna rol: "voluntario" se le generará una clave igual a los últimos 6 dígitos de su DNI.<br> El usuario podrá
                    luego modificarla en la opcion "Contraseñas" del menú principal.
                </p>
            </div>        
            <form class="formulario" action="admin.php" id="CrearUsuario" method="POST">
                <div class="row rowForm" >
                    <label class="col-2 fwb">Nombre:</label>  
                    <input class="col-3 input" type="text" required name="name" autocomplete="off" value="">    
                    <div class="offset-1"></div>
                    <label class="col-2 fwb">Apellido:</label>    
                    <input class="col-3 input" type="text" required autocomplete="off" name="lastName" value="">
                </div>  
                <div class="row rowForm" >
                    <label class="col-2 fwb">DNI:</label>
                    <input class="col-3 input" type="int" required autocomplete="off" name="dni" value=""> 
                    <div class="offset-1"></div>    
                    <label class="col-2 fwb">Rol:</label>    
                    <select class="col-3" name="rol">
                        <option value="postulante">Postulante</option>
                        <option value="voluntario">Voluntario</option>
                    </select>   
                </div>  
                <div class="row rowForm" >
                    <label class="col-2 fwb">Email:</label>
                    <input class="col-3 input" type="email" autocomplete="off" name="email" placeholder="Solo rol voluntario" value=""> 
                    <div class="offset-1"></div>
                    <div class="offset-2"></div> 
                    <input  type="submit" class="col-3 botonInput" name="crearUsuario" value="crear">
                </div>
                <div class="rowForm <?php echo $colorMensaje?>" id="mensajeCrearUsuario">
             
                        <?php echo $mensajeUsuarios?> 

                </div> 
            </form> 
        </div>
    </article>     
    <!-- Modificar Usuario -->
    <article>    
        <nav class="justify-content-between">   
            <h6 class="nameArticle">Modificar usuario</h6> 
            <button class="verMas" name="ModificarUsuario" id="verMasModificarUsuario"> Ver +</button>
            <button class="verMenos ocultar" name="ModificarUsuario" id="verMenosModificarUsuario"> Ver -</button>  
        </nav>
        <div class="<?php echo $visibilidadCajaModificarUsuario?>" id="cajaModificarUsuario">    
            <div class="rowForm">
                <p>   
                    Opción no disponible aún.
                </p>
            </div>
        </div>
    </article>  
    <!-- Eliminar Usuario -->
    <article>    
        <nav class="justify-content-between">   
            <h6 class="nameArticle">Eliminar usuario</h6> 
            <button class="verMas" name="EliminarUsuario" id="verMasEliminarUsuario"> Ver +</button>
            <button class="verMenos ocultar" name="EliminarUsuario" id="verMenosEliminarUsuario"> Ver -</button>  
        </nav>
        <div class="<?php echo $visibilidadCajaEliminarUsuario?>" id="cajaEliminarUsuario">    
            <div class="rowForm">
                <p>   
                    Opción no disponible aún.
                </p>
            </div>
        </div>
    </article>  
</div>