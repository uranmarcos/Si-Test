<?php
 
 $password = substr($_POST["dni"], -6);
 echo($password);


 ?>


<form action="pruebas.php" method ="post">  
    <input type="text" id="inputDni" autocomplete = "off" name="dni">
    <input type="submit" onclick="capturarDni()">
</form>    
<div  id="mostrar" style="width: 100px; height:100px; border: solid 1px red;">
</div>    


<script>
    
    var inputDni = document.getElementById("inputDni");
    var texto = inputDni.value;
    var password= texto.slice(2,9);    
    console.log(password);
    
   
</script>
<!--
<script language="javascript">     
    function recibir()
    {
        var valor = document.getElementById("texto").value;
        document.write(valor);        
        
    }        
</script> 


<body>

<form id="formulario" method="Post">

<input type="text" id="texto"/>
<input type="button" name="enviar" value="Enviar" onclick="recibir();"/>

</form>

</body> 