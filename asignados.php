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
    <script src="js/shared.js"></script>
    <link href="css/general.css" rel="stylesheet"> 
    <link href="css/notificacion.css" rel="stylesheet"> 
  
 
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
                    <span class="pointer" @click="irA('inicio')">Inicio</span>
                 
                    <span class="mx-2 grey"> - Usuarios </span>
                </div>
            </div>
            <!-- END BREADCRUMB -->
         
            <!-- START OPCIONES USUARIOS -->
            <div class="row mb-3">
                <div class="col-sm-12 px-0 col-md-6">
                    <select class="form-control" name="filtro" id="filtro" @change="consultarUsuarios" v-model="filtro">
                        <option v-for="opcion in opciones" v-bind:value="opcion">{{opcion}}</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 px-0 d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Crear
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" @click="modalCrearUsuario=true">Manual</a></li>
                            <li><a class="dropdown-item" href="carga.php">Archivo</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END OPCIONES USUARIOS -->
            
            <!-- START COMPONENTE LOADING BUSCANDO USUARIOS -->
            <div class="contenedorLoading" v-if="buscandoUsuarios">
                <div class="loading">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <!-- END COMPONENTE LOADING BUSCANDO USUARIOS -->

            <!-- START TABLA -->
            <div v-else>
                <table class="table" v-if="usuarios.length != 0">
                    <thead>
                        <tr>
                            <th scope="col">Provincia</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Dni</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Raven</th>
                            <th scope="col">CT</th>
                            <th scope="col">Habilitado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div  v-if="this.usuarios.length != 0">
                            <tr v-for="usuario in usuarios">
                                <td>{{usuario.provincia}}</td>
                                <td>{{usuario.nombre}}</td>
                                <td>{{usuario.apellido}}</td>
                                <td>{{usuario.dni}}</td>
                                <td>{{usuario.telefono}}</td>
                                <td>{{usuario.rol == "postulante" ? usuario.pass : "-"}}</td>
                                <td>{{usuario.raven}}</td>
                                <td>{{usuario.ct}}</td>
                                <td>{{usuario.habilitado == 1 ? "S" : "N"}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" @click="eliminarUsuario(usuario)" href="#">Eliminar</a></li>
                                            <li><a class="dropdown-item" href="carga.php">Resetear Contraseña</a></li>
                                            <li><a class="dropdown-item" href="carga.php">Editar</a></li>
                                            <li><a class="dropdown-item" href="carga.php">Asignar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </tbody>
                

                
                </table>
                <div class="contenedorTabla" v-else>
                    <span class="sinResultados">
                        NO SE ENCONTRÓ RESULTADOS PARA MOSTRAR
                    </span>
                </div>       

            </div>
            <!-- END TABLA -->


            <!-- EMPIEZAN COMPONENTES MODAL Y NOTIFICACION -->

            <!-- START MODAL NUEVO USUARIO -->
            <div v-if="modalCrearUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">NUEVO USUARIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre (*) <span class="errorLabel" v-if="errorNombre">{{errorNombre}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Apellido (*) <span class="errorLabel" v-if="errorApellido">{{errorApellido}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.apellido">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Provincia</label>
                                    <select class="form-control" :disabled="pedirConfirmacion" name="provincia" id="provincia" v-model="usuario.provincia">
                                        <option v-for="provincia in provincias" v-bind:value="provincia" >{{provincia}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuario.dni">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Telefono</label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.telefono">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Rol (*) </label>
                                    <select class="form-control" :disabled="pedirConfirmacion" name="rol" v-model="usuario.rol">
                                        <option value="postulante">Postulante</option>
                                        <option value="voluntario">Voluntario</option>
                                        <option value="general">General</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Mail (*) <span class="errorLabel" v-if="errorMail">{{errorMail}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="60" id="mail" v-model="usuario.mail">
                                </div>
                            </div>
                        </div>
                        <div v-if="!confirmandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacion">
                                <button type="button" class="botonCancelar" @click="cancelarCrearUsuario()">Cancelar</button>
                                <button type="button" @click="crearUsuario"  class="boton">Crear</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacion">
                                <div class="row d-flex justify-content-center">
                                    ¿Confirma la creación del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacion = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarUsuario()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="confirmandoUsuario">
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="contenedorLoadingModal">
                                    <div class="loading">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>   
            <!-- END MODAL NUEVO USUARIO -->

            <!-- START MODAL ELIMINAR USUARIO -->
            <div v-if="modalEliminarUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ELIMINAR USUARIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Nombre</label>
                                    <input disabled class="form-control" v-model="usuarioEliminable.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="apellido">Apellido</label>
                                    <input disabled class="form-control" v-model="usuarioEliminable.apellido">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">DNI </label>
                                    <input disabled class="form-control" v-model="usuarioEliminable.dni">
                                </div>                 
                            </div>
                        </div>
                        <div v-if="!eliminandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionEliminar">
                                <button type="button" class="botonCancelar" @click="cancelarEliminarUsuario()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" @click="pedirConfirmacionEliminar= true"  class="boton">Eliminar</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacionEliminar">
                                <div class="row d-flex justify-content-center">
                                    ¿Confirma la eliminación del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacionEliminar = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarEliminarUsuario()">Confirmar</button>
                                </div>
                            </div>
                        </div>
                        <div v-if="eliminandoUsuario">
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="contenedorLoadingModal">
                                    <div class="loading">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
            <!-- END MODAL ELIMINAR USUARIO -->

            <!-- START NOTIFICACION -->
            <div role="alert" id="mitoast" aria-live="assertive" aria-atomic="true" class="toast">
                <div class="toast-header">
                    <!-- Nombre de la Aplicación -->
                    <div class="row tituloToast" id="tituloToast">
                        <strong class="mr-auto">{{tituloToast}}</strong>
                    </div>
                </div>
                <div class="toast-content">
                    <div class="row textoToast">
                        <strong >{{textoToast}}</strong>
                    </div>
                </div>
            </div>
            <!-- END NOTIFICACION -->

        </div>
    </div>

    <style scoped>
     
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                modalEliminarUsuario: false,
                modalCrearUsuario: false,
                usuarios: [],
                usuario:{
                    provincia: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    telefono: null,
                    rol: null,
                    mail: null
                },
                usuarioEliminable:{
                    id: null,
                    nombre: null,
                    apellido: null,
                    dni: null
                },
                errorNombre: "",
                errorApellido: "",
                errorDni: "",
                errorTelefono: "",
                errorMail: "",
                filtro: "voluntarios",
                opciones:[
                    "voluntarios",
                    "2023",
                    "2022",
                    "anteriores"
                ],
                buscandoUsuarios: false,
                page: 1,
                provincias: [
                    "Buenos Aires",
                    "CABA",
                    "Catamarca",
                    "Chaco",
                    "Chubut",
                    "Córdoba",
                    "Corrientes",
                    "Entre Ríos",
                    "Formosa",
                    "Jujuy",
                    "La Pampa",
                    "La Rioja",
                    "Mendoza",
                    "Misiones",
                    "Neuquén",
                    "Río Negro",
                    "Salta",
                    "San Juan",
                    "San Luis",
                    "Santa Cruz",
                    "Santa Fe",
                    "Santiago del Estero",
                    "Tierra del Fuego",
                    "Tucumán"
                ],
                pedirConfirmacion: false,
                confirmandoUsuario: false,
                tituloToast: null,
                textoToast: null,
                pedirConfirmacionEliminar: false,
                eliminandoUsuario: false
            },
            mounted () {
                this.consultarUsuarios()
            },
            methods:{
                consultarUsuarios() {
                    this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    formdata.append("filtro", this.filtro);
                    formdata.append("buscador", null);
                    if (this.page == 1) {
                        formdata.append("inicio", 0);
                    } else {
                        formdata.append("inicio", ((app.page -1) * 10));
                    }
                    // this.consultarCantidad()

                    axios.post("funciones/acciones.php?accion=getUsuarios", formdata)
                    .then(function(response){    
                        app.buscandoUsuarios = false;
                        console.log(response.data);
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            // app.mostrarToast("Éxito", response.data.mensaje);
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuarios;
                            } else {
                                app.usuarios = []
                            }
                        }
                    }).catch( error => {
                        console.log(error);
                        app.buscandoUsuarios = false;
                        app.mostrarToast("Error", "No se pudo recuperar los usuarios");
                    });
                },

                // FUNCIONES CREACION USUARIO
                crearUsuario () {
                    this.pedirConfirmacion = true;
                },
                cancelarCrearUsuario () {
                    this.modalCrearUsuario = false;
                    this.resetNuevoUsuario();
                },
                confirmarUsuario () {
                    this.confirmandoUsuario = true;
                    let formdata = new FormData();
                   
                    formdata.append("provincia", app.usuario.provincia);
                    formdata.append("nombre", app.usuario.nombre);
                    formdata.append("apellido", app.usuario.apellido);
                    formdata.append("dni", app.usuario.dni);
                    formdata.append("telefono", app.usuario.telefono);
                    formdata.append("rol", app.usuario.rol);
                    formdata.append("mail", app.usuario.mail);
                    formdata.append("asignado", 1);
                    console.log(this.usuario.telefono);
                    axios.post("funciones/acciones.php?accion=crearUsuario", formdata)
                    .then(function(response){
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            app.pedirConfirmacion = false;
                            app.modalCrearUsuario = false;
                            app.mostrarToast("Éxito", response.data.mensaje);
                            app.consultarUsuarios();
                            app.resetNuevoUsuario();
                        }
                        app.confirmandoUsuario = false;
                    }).catch( error => {
                        app.confirmandoUsuario = false;
                        app.mostrarToast("Error", "No se pudo crear el usuario");
                    })
                },
                // FUNCIONES ELIMINAR USUARIO
                    eliminarUsuario (param) {
                        this.modalEliminarUsuario = true;
                        this.usuarioEliminable.id = param.id;
                        this.usuarioEliminable.nombre = param.nombre;
                        this.usuarioEliminable.apellido = param.apellido;
                        this.usuarioEliminable.dni = param.dni;
                    },
                    cancelarEliminarUsuario () {
                        this.modalEliminarUsuario = false;
                        this.resetUsuarioEliminable();
                    },
                    resetUsuarioEliminable () {
                        this.usuarioEliminable.id = null;
                        this.usuarioEliminable.nombre = null;
                        this.usuarioEliminable.apellido = null;
                        this.usuarioEliminable.dni = null;
                    },
                    confirmarEliminarUsuario() {
                        this.eliminandoUsuario = true;
                        let formdata = new FormData();
                        formdata.append("idUsuario", app.usuarioEliminable.id);

                        axios.post("funciones/acciones.php?accion=eliminarUsuario", formdata)
                        .then(function(response){    
                            app.eliminandoUsuario = false;
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.modalEliminarUsuario = false;
                                app.resetUsuarioEliminable();
                                app.consultarUsuarios(); 
                            }
                        });
                    },
                    resetNuevoUsuario () {
                        this.usuario = {
                            provincia: null,
                            nombre: null,
                            apellido: null,
                            dni: null,
                            telefono: null,
                            rol: null,
                            mail: null
                        }
                    },
                // FUNCIONES ELIMINAR USUARIO

                mostrarToast(titulo, texto) {
                    app.tituloToast = titulo;
                    app.textoToast = texto;
                    var toast = document.getElementById("mitoast");
                    var tituloToast = document.getElementById("tituloToast");
                    toast.classList.remove("toast");
                    toast.classList.add("mostrar");
                    setTimeout(function(){ toast.classList.toggle("mostrar"); }, 10000);
                    if (titulo == 'Éxito') {
                        toast.classList.remove("bordeError");
                        toast.classList.add("bordeExito");
                        tituloToast.className = "exito";
                    } else {
                        toast.classList.remove("bordeExito");
                        toast.classList.add("bordeError");
                        tituloToast.className = "errorModal";
                    }
                },
            }
        })
    </script>
</body>
</html>