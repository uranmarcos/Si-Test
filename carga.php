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
   
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
    <link href="css/general.css" rel="stylesheet"> 
  
  
 
</head>
<body>
    <header class="row fwb  header justify-content-between align-items-center">
        <h4 class="col-4 leftTexto">¡Hola Marcos!</h4>
        <a class="col-4 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
    </header>  
    <div id="app">
        <div class="container">
            <!-- START BREADCRUMB -->
              <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer mr-2" @click="irA('inicio')">Inicio</span>
                    <span> - </span>
                    <span class="pointer mr-2" @click="irA('asignados')">Asignados</span>
                    <span> - </span>
                    <span class="ml-2 grey"> Carga de usuarios </span>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="alert alert-warning d-flex justify-content-center" role="alert">
            La carga por archivo solo permite crear usuarios con rol "postulante"
            </div>

            <div class="row my-3 d-flex justify-content-between">
                <div class="col-12 px-0 col-md-4">
                    <input type="file" class="form-control" @change="cargaArchivo($event)" id="excelInput">
                </div>
                <div class="col-12 px-0 col-md-3 d-flex justify-content-end">
                    <button type="button" class="boton" @click="volver">Volver</button>
                </div>
                
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Provincia</th>
                            <th scope="col">Nombre (*)</th>
                            <th scope="col">Apellido (*)</th>
                            <th scope="col">Dni (*)</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuarios">
                            <td><input type="text" class="inputTabla" v-model="usuario[0]"></td>
                            <td><input type="text" class="inputTabla" v-model="usuario[1]"></td>
                            <td><input type="text" class="inputTabla" v-model="usuario[2]"></td>
                            <td><input type="text" class="inputTabla" v-model="usuario[3]"></td>
                            <td><input type="text" class="inputTabla" v-model="usuario[4]"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            <div class="row mt-4 d-flex justify-content-end " v-if="usuarios.length != 0">
                <div class="col-12 col-md-4 px-0 d-flex justify-content-end">
                    <button type="button" @click="crear" class="boton">Crear Usuarios</button>
                </div>
            </div>
        </div>
    </div>

    <style scoped>
        th {
            text-transform: uppercase;
        }
        th, td{
            text-align:center;
        }
        .row{
            width: 100;
            margin: auto;
        }
        .inputTabla{
            max-width: 150px;
            border: 1px solid lightgrey;
        }
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                usuarios: [],
                filtro: "voluntarios",
                opciones:[
                    "voluntarios",
                    "2023",
                    "2022",
                    "anteriores"

                ],
                rol: ""
            },
            methods:{
                async cargaArchivo (event) {
                    const content = await readXlsxFile(event.target.files[0])
                    this.usuarios = content.slice(1, content.length)
                },
                volver () {
                    if (this.rol == "admin") {
                        window.location.href = 'usuariosr.php';  
                    } else {
                        window.location.href = 'asignados.php';  
                    }
                },
                crear () {
                    console.log(this.usuarios);
                },
                validarForm () {

                },
                irA(param) {
                    switch (param) {
                        case "inicio":
                            window.location.href = 'adminr.php';        
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