/*let botonUsuarios = document.querySelector("#botonUsuarios");
let botonPassword = document.querySelector("#botonPassword");


botonUsuarios.addEventListener('click', resaltarBotonUsuarios());

function resaltarBotonUsuarios(){
    botonUsuarios.className="botonResaltado";
    let consultaClasePassword = botonPassword.hasClass('botonResaltado');
    if(consultaClasePassword == true){
        botonPassword.removeClass('botonResaltado');
    }
}


botonPassword.addEventListener('click', resaltarBotonPassword());

function resaltarBotonPassword(){
    botonPassword.className="botonResaltado";
    
    let consultaClaseUsuarios = botonUsuarios.hasClass('botonResaltado');
    if(consultaClaseUsuarios == true){
      x  botonUsuarios.removeClass('botonResaltado');
    }
}

*/







/*Crear Usuario*/
let verMas = document.querySelectorAll('.verMas');
let verMenos = document.querySelectorAll('.verMenos');

verMas.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
       
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.classList.remove("ocultar");
        console.log(opcionElegida);

        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.classList.remove("ocultar");
    })
})

verMenos.forEach(function(boton){
    boton.addEventListener('click', function(){
        opcionElegida = boton.getAttribute("name");
       
        console.log(opcionElegida);            
        botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
        botonVerMenos.className="ocultar";
        cajaAMostrar = document.querySelector('#caja' + opcionElegida);
        cajaAMostrar.className="ocultar";
    
        botonVerMas = document.querySelector('#verMas' + opcionElegida);
        botonVerMas.classList.remove("ocultar");
    })
})
/*
verMas.addEventListener('click', mostrarCaja);
function mostrarCaja(){
    let opcionElegida= verMas.getAttribute("name");
    let botonVerMas = document.querySelector('#verMas' + opcionElegida);
    botonVerMas.className="ocultar";
    
    let botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
    botonVerMenos.classList.remove("ocultar");
}

verMenos.addEventListener('click', ocultarCaja);
function ocultarCaja(){
    let opcionElegida= verMenos.getAttribute("name");
    let botonVerMenos = document.querySelector('#verMenos' + opcionElegida);
    botonVerMenos.className="ocultar";
   
    let botonVerMas= document.querySelector('#verMas' + opcionElegida);
    botonVerMas.classList.remove("ocultar");
}



let verMasConsultaPassword = document.querySelector("#verMasConsultaPassword");
let verMenosConsultaPassword = document.querySelector("#verMenosConsultaPassword");
let cajaConsultarPassword = document.querySelector("#cajaConsultarPassword");

verMasConsultaPassword.addEventListener('click', mostrarCajaConsultarPassword);
function mostrarCajaConsultarPassword(){
    verMenosConsultaPassword.classList.remove("ocultar");
    verMasConsultaPassword.className="ocultar";
    cajaConsultarPassword.classList.remove("ocultar");
}

verMenosConsultaPassword.addEventListener('click', ocultarCajaConsultarPassword);
function ocultarCajaConsultarPassword(){
    verMenosConsultaPassword.className="ocultar";
    verMasConsultaPassword.classList.remove("ocultar");
    cajaConsultarPassword.className="ocultar";
}

let verMasResetPassword = document.querySelector("#verMasResetPassword");
let verMenosResetPassword = document.querySelector("#verMenosResetPassword");

let cajaResetPassword = document.querySelector("#cajaResetPassword");

verMasResetPassword.addEventListener('click', mostrarCajaResetPassword);

function mostrarCajaResetPassword(){
    verMenosResetPassword.classList.remove("ocultar");
    verMasResetPassword.className="ocultar";
    cajaResetPassword.classList.remove("ocultar");
}

verMenosResetPassword.addEventListener('click', ocultarCajaResetPassword);
function ocultarCajaResetPassword(){
    verMenosResetPassword.className="ocultar";
    verMasResetPassword.classList.remove("ocultar");
    cajaResetPassword.className="ocultar";
}

let verMasCambiarPassword = document.querySelector("#verMasCambiarPassword");
let verMenosCambiarPassword = document.querySelector("#verMenosCambiarPassword");
let cajaCambiarPassword = document.querySelector("#cajaCambiarPassword");

verMasCambiarPassword.addEventListener('click', mostrarCajaCambiarPassword);
function mostrarCajaCambiarPassword(){
    verMenosCambiarPassword.classList.remove("ocultar");
    verMasCambiarPassword.className="ocultar";
    cajaCambiarPassword.classList.remove("ocultar");
}

verMenosCambiarPassword.addEventListener('click', ocultarCajaCambiarPassword);
function ocultarCajaCambiarPassword(){
    verMenosCambiarPassword.className="ocultar";
    verMasCambiarPassword.classList.remove("ocultar");
    cajaCambiarPassword.className="ocultar";
}


let verMasHabilitarTest = document.querySelector('#verMasHabilitarTest');
let verMenosHabiitarTest = document.querySelector("#verMenosHabilitarTest");
let cajaHabilitarTest = document.querySelector("#cajaHabilitarTest");

verMasHabilitarTest.addEventListener('click', mostrarCajaHabilitarTest);
function mostrarCajaHabilitarTest(){
    verMasHabilitarTest.className="ocultar";
    verMenosHabiitarTest.classList.remove("ocultar");
    cajaHabilitarTest.classList.remove("ocultar");

}

verMenosHabilitarTest.addEventListener('click', ocultarCajaHabilitarTest);
function ocultarCajaHabilitarTest(){
    verMenosHabiitarTest.className="ocultar";
    verMasHabilitarTest.classList.remove("ocultar");
    cajaHabilitarTest.className="ocultar";
}

let verMasBloquearTest = document.querySelector('#verMasBloquearTest');
let verMenosBloquearTest = document.querySelector('#verMenosBloquearTest');
let cajaBloquearTest = document.querySelector('#cajaBloquearTest');

verMasBloquearTest.addEventListener('click', mostrarCajaBloquearTest);
function mostrarCajaBloquearTest(){
    verMasBloquearTest.className="ocultar";
    verMenosBloquearTest.classList.remove("ocultar");
    cajaBloquearTest.classList.remove("ocultar");
}

verMenosBloquearTest.addEventListener('click', ocultarCajaBloquearTest);
function ocultarCajaBloquearTest(){
    verMenosBloquearTest.className="ocultar";
    verMasBloquearTest.classList.remove("ocultar");
    cajaBloquearTest.className="ocultar";
}



let verMasConsultarAvance = document.querySelector('#verMasConsultarAvance');
let verMenosConsultarAvance = document.querySelector('#verMenosConsultarAvance');
let cajaConsultarAvance = document.querySelector('#cajaConsultarAvance');

verMasConsultarAvance.addEventListener('click', mostrarCajaConsultarAvance);
function mostrarCajaConsultarAvance(){
    verMasConsultarAvance.className="ocultar";
    verMenosConsultarAvance.classList.remove("ocultar");
    cajaConsultarAvance.classList.remove("ocultar");
}

verMenosConsultarAvance.addEventListener('click', ocultarCajaConsultarAvance);
function ocultarCajaConsultarAvance(){
    verMasConsultarAvance.classList.remove("ocultar");
    verMenosConsultarAvance.className="ocultar";
    cajaConsultarAvance.className="ocultar";
}
*/