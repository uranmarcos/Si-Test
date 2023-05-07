<?php


?>
<head>
    <link href="header2.css" rel="stylesheet">
<head>
<header class="fwb purple header align-items-center">
    <div class="navLeft">
        <!-- <p>¡Hola <?php echo $_SESSION["name"]?>!</p> -->
        <p>¡Hola Marcos!</p>
    </div>
    <div class="navRight">
        <button id="menu">Menu</button>
            <nav id="superior">
                <ul class="opciones-burguer">
                    <li><a class="opciones-menu" href="<?php echo $estadisticas?>">Cambiar Contraseña</a></li>
                    <li><a class="opciones-menu" href="<?php echo $logOut ?>">Cerrar sesión</a></li>
                </ul>
            </nav>      
        </div>        
</header>




