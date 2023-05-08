<?php
session_start();
// if (!$_SESSION["login"] ) {
//     header("Location: index.html");
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI PEDIDOS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="css/general.css" rel="stylesheet"> 
 
</head>
<body>
    <?php require("shared/header.html")?>
    <div id="app">
      
        <div class="contenedor">
             <!-- START BREADCRUMB -->
             <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer">Inicio</span>
                </div>
            </div>
            <!-- END BREADCRUMB -->
            <div class="row mt-6">
                <div class="col-12 col-sm-6 col-md-3 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" @click="irA('usuarios')">
                    
                        USUARIOS
        
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" @click="irA('asignados')">
                    
                        ASIGNADOS
        
                    </div>
                </div>
               
                <div class="col-12 col-sm-6 col-md-3 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones"  @click="irA('seguimiento')">
                        SEGUIMIENTO
                    </div>
                </div>

                <!-- PARA ADMIN -->
                <div class="col-12 col-sm-6 col-md-3 col-sm-12 my-2 my-md-5 d-flex justify-content-center">
                    <div class="opciones" @click="irA('avance')">
                    
                        AVANCE
        
                    </div>
                </div>
                <!-- PARA ADMIN -->
            </div>
        </div>
    </div>
    <style scoped>
        

    .opciones{
        flex-direction: column;
        border: solid 1px rgb(124, 69, 153);
        border-radius: 10px;
        color: rgb(124, 69, 153);
        text-transform: uppercase;
        text-align: center;
        width: 95%;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .opciones:hover{
        cursor: pointer;
        background: rgb(124, 69, 153);
        color: white;
    }
            
    </style>

  
    <script>
        var app = new Vue({
            el: "#app",
            components: {
                
            },
            data: {
               
            },
            methods:{
                irA(param) {
                    switch (param) {
                        case "usuarios":
                            window.location.href = 'usuariosr.php';        
                            break;
                    
                        case "avance":
                            window.location.href = 'avance.php';        
                            break;

                        case "seguimiento":
                            window.location.href = 'seguimiento.php';        
                            break;

                        case "asignados":
                            window.location.href = 'asignados.php';         
                            break;
                        default:
                            break;
                    }
                }
            }
        })
    </script>
</body>
</html>