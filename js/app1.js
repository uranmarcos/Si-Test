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