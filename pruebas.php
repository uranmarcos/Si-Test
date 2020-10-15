
<?php

session_start();
require("pdo.php");



/*
$dni = $_SESSION["dni"];

//almaceno en base de datos el tiempo restante al cambiar de nivel.
if($_POST){
    if ($_POST["siguiente"]){
        $tiempoRaven = $_POST["tiempoRaven"];
        $matriz=explode(":",$tiempoRaven); //con eso hemos conseguido $matriz[0]=34  y $matriz[1]=12.
        $tiempoRestante=($matriz[0]*60)+$matriz[1]; 
        
        $consulta =  $baseDeDatos -> prepare
            ("UPDATE usuarios SET tiempoRaven='$tiempoRestante' WHERE dni = '$dni'");
            $consulta -> execute();
    }
}    


            //consulto en base de datos tiempo disponible y almaceno en variable.
            $consulta = $baseDeDatos-> prepare
                            ("SELECT tiempoRaven FROM usuarios WHERE dni = '$dni'");
                $consulta->execute();
                $consultaRaven = $consulta->fetch(PDO::FETCH_ASSOC);

                $tiempo = $consultaRaven["tiempoRaven"];


?>

<!--asigno a js el valor disponible para el usuario en bdd -->


<!-- cargado ya-->
<script type="text/javascript">
               var seg = <?php echo $tiempo?> 
              
</script>  

<body onload="start()">

   
    <?php  echo "<script>alert('hola');</script>";?>

    <div class="container" style="background-color:red; width: 300px; height:300px;
    font-size: 50px;
    text-align:center;">
    </div>
    <form action = "pruebas.php" method ="post">
        <input type="button" class="start" value="Start">
        <input type="text" name="tiempoRaven" id="tiempoRaven">
        <input type="submit" class="start"name="siguiente" id="siguiente" value="siguiente">
    </form>    

</body>




<script>
var container = document.querySelector(".container");
var start = document.querySelector(".start");
var siguiente = document.getElementById("siguiente");
var tiempoRaven = document.getElementById("tiempoRaven");

var contador= setInterval(function(){
                
                container.innerText = seg;
                function secondsToString(seg) {
                    var minute = Math.floor((seg / 60) % 60);
                    minute = (minute < 10)? '0' + minute : minute;
                    var second = seg % 60;
                    second = (second < 10)? '0' + second : second;
                    return  minute + ':' + second;
                    
                }

                var terminar = secondsToString(seg);

              
                tiempoRaven.value= terminar;
                seg--;

                var terminar = seg==2600;
                 if(terminar== true){
                     alert("hola");
                 }
                
            },1000)



siguiente.onclick = function(){
    clearInterval(contador);
    console.log("se detuvo");
}


function start(){
    setInterval(function(){
            container.innerText = seg;
            seg--;
                
            },1000)
}



</script>            */
if($_POST){
var_dump($_POST["mostrarTiempo"]);
}         
?>
                <form method="POST" action="pruebas.php">
                    <div class="row menu justify-content-around">    
                            
                            <input class="col-4" type="text"    name="mostrarTiempo" value="Tiempo" id="mostrarTiempo" style="text-align:center; font-size:20px;">
                            
                            
                    </div>     
                    <input type="submit">
                </form>    
