
/* Validacion campos CREAR USUARIO */
let campoCrearUsuario = document.querySelectorAll(".campoCrearUsuario");
let mensajeCrearUsuario = document.querySelector("#mensajeCrearUsuario");

campoCrearUsuario.forEach(function(boton){
    boton.addEventListener('focus', function(){
        boton.addEventListener('keyup', function(){
            let inputFocus = boton.getAttribute("name");
            let datoIngresado = boton.value;
            if(inputFocus == "name"){
                if(datoIngresado.length<3){
                    mensajeCrearUsuario.innerHTML="El nombre debe poseer mínimo 3 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";    
                }
            }    
            if(inputFocus == "lastName"){
                if(datoIngresado.length<3){
                    mensajeCrearUsuario.innerHTML="El apellido debe poseer mínimo 3 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";    
                }
            }
            if(inputFocus == "dni"){
                if(datoIngresado.length!=8){
                    mensajeCrearUsuario.innerHTML="El dni debe poseer mínimo 8 caracteres";    
                }else{
                    mensajeCrearUsuario.innerHTML="";
                }
            }    
            if(inputFocus == "email"){
                if((datoIngresado.includes("@")==false) || (datoIngresado.includes(".")==false)) {
                    mensajeCrearUsuario.innerHTML="El mail debe ser del tipo ejemplo@ejemplo.com";    
                }else{
                    mensajeCrearUsuario.innerHTML="";
                }
            }    
        })
    })    
})                
       
    
   


/* Funciones para botones "ver +" y "ver -"   */
let verMas = document.querySelectorAll('.verMas');
let verMenos = document.querySelectorAll('.verMenos');

verMas.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
       
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.classList.remove("ocultar");
        
        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.classList.remove("ocultar");
    })
})

verMenos.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
                     
        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.className="ocultar";
    
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.classList.remove("ocultar");
    })
})