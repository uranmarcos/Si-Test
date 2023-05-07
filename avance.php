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
  
  
 
</head>
<body>
    <header class="row fwb  header justify-content-between align-items-center">
        <h4 class="col-4 leftTexto">¡Hola Marcos!</h4>
        <a class="col-4 centrarTexto" href="cerrarSesion.php">Cerrar Sesión</a>
    </header>  
    <div id="app">
        <div class="container">
            <!-- <div class="row mt-4">
                <div class="col-12 col-md-4">
                    <input type="file" class="form-control" @change="cargaArchivo($event)" id="excelInput">
                </div>
            </div> -->
            <div class="row mt-4">
                
                    <div class="card mx-3" style="width: 15rem;" v-for="usuario in usuarios">
                        <div class="card-body">
                            <h5 class="card-title">{{usuario.nombre}}</h5>
                        </div>
                        
                        <div 
                            class="card-body"
                        >
                            <span 
                                class="principal"
            
                            >
                                {{usuario.terminados}} / {{usuario.asignados}}
                            </span>     
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> {{usuario.terminados}} terminados</li>
                            <li class="list-group-item"> {{usuario.enProceso}} empezados</li>
                            <li class="list-group-item">{{(usuario.asignados - usuario.terminados - usuario.enProceso) }} pendientes</li>
                            <li class="list-group-item">
                                <button type="button" class="btn btn-primary">VER DETALLE</button>
                            </li>
                        </ul>
                    </div>
              

                

            </div>
            
           
        </div>
    </div>

    <style scoped>
        .principal {
            width: 10rem;
            height: 10rem;
            border-radius: 50%;
            display: flex;
            font-size: 20px;
            font-weight: bolder;
            justify-content: center;
            background: #B3B4B6;
            align-items: center;
            text-align: center;
            margin:0px auto;
            padding:3%
        }
        .rojo {
            background-color: rgb(255,255,50);
        }
        .naranja {
            background-color: rgb(55,255,50);
        }
        .verde {
            background-color: rgb(30,30,50);
        }
      
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                usuarios: [
                    {
                        nombre: "Hugo",
                        asignados: 30,
                        enProceso: 10,
                        terminados: 5
                    },
                    {
                        nombre: "Laura",
                        asignados: 40,
                        enProceso: 7,
                        terminados: 15
                    },
                    {
                        nombre: "Pepe",
                        asignados: 20,
                        enProceso: 2,
                        terminados: 1
                    }
                ]
            },
            methods:{
                async cargaArchivo (event) {
                    // console.log(param)
                    const content = await readXlsxFile(event.target.files[0])
                    this.usuarios = content.slice(1, content.length)
                    console.log(content)
                }
               
            }
        })
    </script>
</body>
</html>