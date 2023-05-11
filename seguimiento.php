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
    <?php require("shared/header.html")?>
    <div id="app">
        <div class=" contenedor">
            <!-- START BREADCRUMB -->
            <div class="col-12 p-0">
                <div class="breadcrumb">
                    <span class="pointer" @click="irA('inicio')">Inicio</span>
                    <span class="mx-2 grey"> - Seguimiento </span>
                </div>
            </div>
            <!-- END BREADCRUMB -->
         
            <!-- START OPCIONES USUARIOS -->
            <div class="row d-flex justify-content-between mb-3">
                
                <div class="col-6 px-0">
                    <div class="row d-flex justify-content-start">
                        <div class="selectBuscar">
                            <span class="labelBuscar"> Buscar por dni...</span>
                            <input 
                                class="form-control inputBuscar" 
                                autocomplete="off" 
                                v-model="dniBusqueda"
                            >
                        </div>
                        <button 
                            type="button" 
                            @click="buscarUsuario"  
                            class="boton mx-2"
                            v-if="dniBusqueda != null"    
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
        
                        <button 
                            type="button" 
                            @click="borrarBusqueda"  
                            class="botonCancelar mx-"
                            v-if="busqueda"    
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END OPCIONES USUARIOS -->

            <div class="alert alert-warning d-flex justify-content-center" role="alert" v-if="alertBusqueda">
                El usuario buscado está cargado como voluntario 
            </div>
            
          
            <section v-if="usuariosSeguimiento.length != 0" class="row mb-3">
                <div class="col-10 px-0">
                    <span v-for="(usuario, index) in usuariosSeguimiento" :class="index == 0 ? 'mx-0' : 'mx-1' ">
                        <span class="badge text-bg-success"> 
                            {{usuario.nombre}} {{usuario.apellido}} 
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                width="18" 
                                height="18" 
                                fill="currentColor" 
                                class="bi deleteUsuario bi-x-circle" 
                                viewBox="0 0 16 16"
                                @click="deleteUsuario(usuario)"
                            >
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </span>
                </div>
                <div class="col-2 px-0 d-flex justify-content-end">
                    <button 
                        class="boton botonSeguimiento" 
                        type="button"
                    >
                        INICIAR SEGUIMIENTO
                    </button>
                </div>
            </section>

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
                <div>
                    <table class="table" v-if="usuarios.length != 0">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Dni</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Raven</th>
                                <th scope="col">CT</th>
                                <th scope="col">Habilitado</th>
                                <th scope="col" v-if="busqueda">Año</th>
                                <th scope="col">Asignado</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div  v-if="this.usuarios.length != 0">
                                <tr v-for="usuario in usuarios">
                                    <td>
                                        <input 
                                            @change="changeCheck(usuario)" 
                                            type="checkbox"
                                            v-model="usuario.checked"    
                                        >
                                    </td>
                                    <td>{{usuario.dni}}</td>
                                    <td>{{usuario.nombre}}</td>
                                    <td>{{usuario.apellido}}</td>
                                    <td>{{usuario.provincia}}</td>
                                    <td>{{usuario.telefono}}</td>
                                    <td>{{usuario.rol == "postulante" ? usuario.pass : "-"}}</td>
                                    <td>{{usuario.raven}}</td>
                                    <td>{{usuario.ct}}</td>
                                    <td>{{usuario.habilitado == 1 ? "S" : "N"}}</td>
                                    <td v-if="busqueda">{{usuario.anio}}</td>
                                    <td>{{usuario.asignado}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="boton dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" @click="eliminarUsuario(usuario)" href="#" v-if="rol == 'admin' || rol == 'general'">
                                                        Eliminar
                                                    </a>
                                                </li>
                                                <li v-if="(rol == 'admin' || rol == 'general') || usuario.rol == 'postulante'">
                                                    <a class="dropdown-item" @click="resetear(usuario)" href="#">
                                                        Resetear Contraseña
                                                    </a>
                                                </li>
                                                <li v-if="rol == 'admin' || rol == 'general'">
                                                    <a class="dropdown-item" @click="habilitar(usuario)" href="#">
                                                        {{usuario.habilitado == 0 ? 'Habilitar' : 'Bloquear'}}
                                                    </a>
                                                </li>
                                                <li><a class="dropdown-item" @click="edit(usuario)" href="#">Editar</a></li>
                                                <li v-if="rol == 'admin' || rol == 'general'"><a class="dropdown-item" @click="editDni(usuario)" href="#">Modificar DNI</a></li>
                                                <li><a class="dropdown-item" @click="asignarUsuario(usuario)" href="#">Asignar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3 mb-5" v-if="usuarios.length != 0">
                    <div class="col-3 px-0 selectCantidad">
                        <span class="labelCantidad"> Ver de a...</span>
                        <select class="form-control" @change="changeCantidad" v-model="cantidadPorPagina">
                            <option v-for="opcion in opcionesCantidad" v-bind:value="opcion">{{opcion}}</option>
                        </select>
                    </div>
                    <div class="col-9 px-0 d-flex justify-content-end">
                        <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-1 d-flex justify-content-end">
                                <button @click="prev" class="btnPaginacion pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                {{page * cantidadPorPagina - (cantidadPorPagina - 1)}} a {{page * cantidadPorPagina > cantidadUsuarios ? cantidadUsuarios : page * cantidadPorPagina}} de {{cantidadUsuarios == 1 ? " 1 resultado" : cantidadUsuarios >= 2 ? (cantidadUsuarios + " resultados") : ""}}
                            </div>
                            <div class="col-1 d-flex justify-content-start">
                                <button  class="btnPaginacion pointer" @click="next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contenedorTabla" v-else>
                    <span class="sinResultados">
                        NO SE ENCONTRÓ RESULTADOS PARA MOSTRAR
                    </span>
                </div>  
            </div>
            <!-- END TABLA -->


            <!-- EMPIEZAN COMPONENTES MODAL Y NOTIFICACION -->

            <!-- START MODAL CREAR USUARIO -->
            <div v-if="modalCrearUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">NUEVO USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalCrearUsuario = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Rol (*) </label>
                                    <select class="form-control" :disabled="pedirConfirmacion" name="rol" v-model="usuario.rol">
                                        <option value="postulante">Postulante</option>
                                        <option value="voluntario" v-if="rol == 'admin' || rol == 'general'">Voluntario</option>
                                        <option value="general" v-if="rol == 'admin'">General</option>
                                        <option value="admin" v-if="rol == 'admin'">Admin</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre (*) <span class="errorLabel" v-if="errorNombre">{{errorNombre}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Apellido (*) <span class="errorLabel" v-if="errorApellido">{{errorApellido}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.apellido">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuario.dni">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1" v-if="usuario.rol == 'postulante'">
                                    <label for="ciudad">Telefono</label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuario.telefono">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1" v-if="usuario.rol == 'postulante'">
                                    <label for="ciudad">Provincia</label>
                                    <select class="form-control" :disabled="pedirConfirmacion" name="provincia" id="provincia" v-model="usuario.provincia">
                                        <option v-for="provincia in provincias" v-bind:value="provincia" >{{provincia}}</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-12 mt-1" v-if="usuario.rol != 'postulante' && usuario.rol != null">
                                    <label for="ciudad">Mail (*) <span class="errorLabel" v-if="errorMail">{{errorMail}}</span></label>
                                    <input :disabled="pedirConfirmacion" class="form-control" autocomplete="off" maxlength="60" id="mail" v-model="usuario.mail">
                                </div>
                            </div>
                        </div>
                        <div v-if="!creandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacion">
                                <button type="button" class="botonCancelar" @click="cancelarCrearUsuario()">Cancelar</button>
                                <button type="button" @click="crearUsuario"  class="boton">Crear</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacion">
                                <div class="row mb-2 d-flex justify-content-center">
                                    ¿Confirma la creación del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacion = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarUsuario()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="creandoUsuario">
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
            <!-- END MODAL CREAR USUARIO -->

            <!-- START MODAL ELIMINAR USUARIO -->
            <div v-if="modalEliminarUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ELIMINAR USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEliminarUsuario = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
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
                                <div class="row mb-2 d-flex justify-content-center">
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

            <!-- START MODAL ASIGNAR USUARIO -->
            <div v-if="modalAsignarUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ASIGNAR USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalAsignarUsuario = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body" v-if="!buscandoVoluntarios">
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Nombre</label>
                                    <input disabled class="form-control" v-model="usuarioAsignable.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="apellido">Apellido</label>
                                    <input disabled class="form-control" v-model="usuarioAsignable.apellido">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">DNI </label>
                                    <input disabled class="form-control" v-model="usuarioAsignable.dni">
                                </div>     
                                <div class="col-sm-12 mt-3">
                                    <label for="ciudad">VOLUNTARIO ASIGNADO </label>
                                    <select class="form-control" v-model="usuarioAsignable.asignado">
                                        <option v-for="voluntario in voluntarios" v-bind:value="voluntario.id">{{voluntario.voluntario}}</option>
                                    </select> 
                                </div>           
                            </div>
                            <div v-if="!asignandoUsuario">
                                <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionAsignar">
                                    <button type="button" class="botonCancelar" @click="cancelarAsignarUsuario()" id="" data-dismiss="modal">Cancelar</button>
                                    <button type="button" @click="pedirConfirmacionAsignar= true"  class="boton">Asignar</button>
                                </div>
                                <div class="modal-footer" v-if="pedirConfirmacionAsignar">
                                    <div class="row mb-2 d-flex justify-content-center">
                                        ¿Confirma la asignación del usuario?
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <button type="button" class="botonCancelar" @click="pedirConfirmacionAsignar = false">Cancelar</button>
                                        <button type="button" class="boton" @click="confirmarAsignacionUsuario()">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="asignandoUsuario">
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
                        <div class="modal-body" v-if="buscandoVoluntarios">
                            <div class="loading">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>    
            <!-- END MODAL ASIGNAR USUARIO -->

            <!-- START MODAL EDITAR USUARIO -->
            <div v-if="modalEditarUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoUsuario">EDITAR USUARIO</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEditarUsuario = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">Rol (*) </label>
                                    <select class="form-control" :disabled="pedirConfirmacionEditar" name="rol" v-model="usuarioEditable.rol">
                                        <option value="postulante">Postulante</option>
                                        <option value="voluntario">Voluntario</option>
                                        <option value="general">General</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input disabled class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuarioEditable.dni">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre (*) <span class="errorLabel" v-if="errorNombre">{{errorNombre}}</span></label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuarioEditable.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Apellido (*) <span class="errorLabel" v-if="errorApellido">{{errorApellido}}</span></label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuarioEditable.apellido">
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1"  v-if="usuarioEditable.rol == 'postulante'">
                                    <label for="ciudad">Provincia</label>
                                    <select class="form-control" :disabled="pedirConfirmacionEditar" name="provincia" id="provincia" v-model="usuarioEditable.provincia">
                                        <option v-for="provincia in provincias" v-bind:value="provincia" >{{provincia}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mt-1"  v-if="usuarioEditable.rol == 'postulante'">
                                    <label for="ciudad">Telefono</label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuarioEditable.telefono">
                                </div>
                                <div class="col-sm-12 mt-1" v-if="usuarioEditable.rol != 'postulante'">
                                    <label for="ciudad">Mail (*) <span class="errorLabel" v-if="errorMail">{{errorMail}}</span></label>
                                    <input :disabled="pedirConfirmacionEditar" class="form-control" autocomplete="off" maxlength="60" id="mail" v-model="usuarioEditable.mail">
                                </div>
                            </div>
                        </div>
                        <div v-if="!editandoUsuario">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionEditar">
                                <button type="button" class="botonCancelar" @click="cancelarEditarUsuario()">Cancelar</button>
                                <button type="button" @click="editarUsuario"  class="boton">Editar</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacionEditar">
                                <div class="row mb-2 d-flex justify-content-center">
                                    ¿Confirma la edición del usuario?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacionEditar = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarEditarUsuario()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="editandoUsuario">
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
            <!-- END MODAL EDITAR USUARIO -->

            <!-- START MODAL HABILITAR / BLOQUEAR USUARIO -->
            <div v-if="modalHabilitarUsuario">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                HABILITAR/BLOQUEAR USUARIO
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalHabilitarUsuario = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3 d-flex justify-content-center" >
                                    ¿Desea {{usuarioHabilitable.habilitado == 0 ? 'HABILITAR' : 'BLOQUEAR'}} al usuario?
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Usuario</label>
                                    <input disabled class="form-control" v-model="usuarioHabilitable.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="apellido">Rol</label>
                                    <input disabled class="form-control" v-model="usuarioHabilitable.rol">
                                </div> 
                            </div>
                        </div>
                        <div v-if="!habilitandoUsuario">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarHabilitarUsuario()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarHabilitarUsuario()">Confirmar</button>
                            </div>
                        </div>
                        <div v-if="habilitandoUsuario">
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
            <!-- END MODAL HABILITAR / BLOQUEAR USUARIO -->

            <!-- START MODAL RESETEAR CONTRASEÑA -->
            <div v-if="modalResetear">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                Resetear contraseña
                            </h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalResetear = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-3 d-flex justify-content-center" >
                                    ¿Desea resetear la contraseña al usuario?
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">Usuario</label>
                                    <input disabled class="form-control" v-model="usuarioReseteable.nombre">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <label for="nombre">DNI</label>
                                    <input disabled class="form-control" v-model="usuarioReseteable.dni">
                                </div>
                                <!-- <div class="col-sm-12 mt-3">
                                    <label for="apellido">Rol</label>
                                    <input disabled class="form-control" v-model="usuarioReseteable.rol">
                                </div>  -->
                            </div>
                        </div>
                        <div v-if="!reseteando">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="botonCancelar" @click="cancelarResetear()" id="" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="boton" @click="confirmarResetear()">Confirmar</button>
                            </div>
                        </div>
                        <div v-if="reseteando">
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
            <!-- END MODAL RESETEAR CONTRASEÑA -->

            <!-- START MODAL EDITAR DNI -->
            <div v-if="modalEditarDni">
                <div id="myModal" class="modal">
                    <div class="modal-content px-0 py-0">
                        <div class="modal-header">
                            <h5 class="modal-title">EDITAR DNI</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" @click="modalEditarDni = false" width="30" height="30" fill="currentColor" class="bi closeModal bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">Nombre</label>
                                    <input disabled class="form-control" autocomplete="off" maxlength="50" id="nombre" v-model="usuarioDniEditable.nombre">
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <label for="ciudad">DNI (*) <span class="errorLabel" v-if="errorDni">{{errorDni}}</span></label>
                                    <input class="form-control" autocomplete="off" maxlength="8" id="dni" v-model="usuarioDniEditable.dni">
                                </div>
                            </div>
                        </div>
                        <div v-if="!editandoDni">
                            <div class="modal-footer d-flex justify-content-between" v-if="!pedirConfirmacionEditarDni">
                                <button type="button" class="botonCancelar" @click="cancelarEditarDni()">Cancelar</button>
                                <button type="button" @click="editarDni"  class="boton">Editar</button>
                            </div>
                            <div class="modal-footer" v-if="pedirConfirmacionEditarDni">
                                <div class="row mb-2 d-flex justify-content-center">
                                    ¿Confirma la modificación del DNI?
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <button type="button" class="botonCancelar" @click="pedirConfirmacionEditarDni = false">Cancelar</button>
                                    <button type="button" class="boton" @click="confirmarEditarDni()">Confirmar</button>

                                </div>
                            </div>
                        </div>
                        <div v-if="editandoDni">
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
            <!-- END MODAL EDITAR DNI -->            
        
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
        .deleteUsuario{
            margin: 0 5px;
        }
        .deleteUsuario:hover{
            cursor: pointer;
        }
        .botonSeguimiento{
            height: 36px;
            font-size: 12px !important;
        }
        .badge{
            height: 36px !important;
            padding: 10px 5px;
            font-size: 16px;
            color: rgb(124, 69, 153) !important;
            background-color: lightgrey !important;
        }
            
    </style>
    <script>
        var app = new Vue({
            el: "#app",
            components: {
            },
            data: {
                modalCrearUsuario: false,
                modalEliminarUsuario: false,
                modalAsignarUsuario: false,
                modalEditarUsuario: false,
                modalEditarDni: false,
                modalHabilitarUsuario: false,
                modalResetear: false,
                modalBuscar: false,
                busqueda: "default",
                dniBusqueda: null,
                usuarios: [],
                voluntarios: [],
                usuario:{
                    provincia: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    telefono: null,
                    rol: null,
                    mail: null
                },
                usuarioEditable:{
                    provincia: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    telefono: null,
                    rol: null,
                    mail: null,
                    id: null
                },
                usuarioDniEditable:{
                    nombre: null,
                    apellido: null,
                    dni: null,
                    id: null
                },
                usuarioAsignable :{
                    id: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    idAsignado: null
                },
                usuarioEliminable:{
                    id: null,
                    nombre: null,
                    apellido: null,
                    dni: null
                },
                usuarioAsignable :{
                    id: null,
                    nombre: null,
                    apellido: null,
                    dni: null,
                    rol: null,
                    habilitado: null
                },
                usuarioHabilitable :{
                    id: null,
                    nombre: null,
                    rol: null,
                },
                usuarioReseteable :{
                    id: null,
                    nombre: null,
                    rol: null,
                },
                errorNombre: "",
                errorApellido: "",
                errorDni: "",
                errorTelefono: "",
                errorMail: "",
                buscandoUsuarios: false,
                buscandoVoluntarios: false,
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
                creandoUsuario: false,
                editandoUsuario: false,
                asignandoUsuario: false,
                eliminandoUsuario: false,
                habilitandoUsuario: false,
                editandoDni: false,
                reseteando: false,
                buscando: false,
                pedirConfirmacion: false,
                pedirConfirmacionEliminar: false,
                pedirConfirmacionAsignar: false,
                pedirConfirmacionEditar: false,
                pedirConfirmacionEditarDni: false,
                tituloToast: null,
                textoToast: null,
                rol: null,
                nombre: null,
                page: 1,
                cantidadUsuarios: 0,
                opcionesCantidad: [10, 20, 50],
                cantidadPorPagina: 10,
                alertBusqueda: false,
                busqueda: false,
                idUsuario: null,
                usuariosSeguimiento: []
            },
            mounted () {
                // this.contarUsuarios();
                // this.rol = "admin";
                this.rol = "general";
                this.nombre = "Marcos";
                this.idUsuario = 1;
                // this.rol = "voluntario";
                if (this.rol == "voluntario") {
                    this.usuario.rol = "postulante";
                }
                document.getElementById("spanNombre").innerHTML = this.nombre.toUpperCase();
                document.getElementById("spanRol").innerHTML = this.rol.toUpperCase();
                this.consultarUsuarios();
            },
            methods:{
           
                consultarUsuarios() {
                    this.busqueda = false;
                    this.dniBusqueda = null;
                    this.alertBusqueda = false;
                    this.contarUsuarios()
                    this.buscandoUsuarios = true;
                    let formdata = new FormData();
                    const hoy = new Date(Date.now());
                    let anio = hoy.getFullYear();
                    formdata.append("idAsignado", this.idUsuario);
                    formdata.append("cantidad", this.cantidadPorPagina);
                    formdata.append("anio", anio);
                    if (this.page == 1) {
                        formdata.append("inicio", 0);
                    } else {
                        formdata.append("inicio", ((app.page -1) * this.cantidadPorPagina));
                    }
                    axios.post("funciones/acciones.php?accion=getUsuariosAsignados", formdata)
                    .then(function(response){    
                        console.log(response.data);
                        app.buscandoUsuarios = false;
                        if (response.data.error) {
                            app.mostrarToast("Error", response.data.mensaje);
                        } else {
                            if (response.data.usuarios != false) {
                                app.usuarios = response.data.usuarios;
                                app.usuarios.forEach(element => {
                                    element.checked = false;
                                });
                                if (app.usuariosSeguimiento.length != 0) {
                                    app.cargarUsuariosSeguidos();
                                }
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

                // FUNCIONES RESETEAR CONTRASEÑA
                    resetear (usuario) {
                        this.modalResetear = true;
                        this.usuarioReseteable.id = usuario.id;
                        this.usuarioReseteable.dni = usuario.dni;
                        this.usuarioReseteable.nombre = usuario.nombre + ' ' + usuario.apellido ;
                        this.usuarioReseteable.rol = usuario.rol;
                    },
                    cancelarResetear () {
                        this.modalResetear = false;
                        this.resetUsuarioReseteable();
                    },
                    resetUsuarioReseteable () {
                        this.usuarioReseteable.id = null;
                        this.usuarioReseteable.dni = null;
                        this.usuarioReseteable.nombre = null;
                        this.usuarioReseteable.rol = null
                    },
                    confirmarResetear () {
                        this.reseteando = true;
                        let formdata = new FormData();
                    
                        formdata.append("idUsuario", app.usuarioReseteable.id);
                        formdata.append("dni", app.usuarioReseteable.dni);
                        formdata.append("rol", app.usuarioReseteable.rol);
                    
                        axios.post("funciones/acciones.php?accion=resetear", formdata)
                        .then(function(response){
                            if (response.data.error) {
                                app.mostrarToast("Error", response.data.mensaje);
                            } else {
                                app.modalResetear = false;
                                app.mostrarToast("Éxito", response.data.mensaje);
                                app.consultarUsuarios();
                                app.resetUsuarioReseteable();
                            }
                            app.reseteando = false;
                        }).catch( error => {
                            app.reseteando = false;
                            app.mostrarToast("Error", "No se pudo resetar la contraseña");
                        })
                    },
                // FUNCIONES RESETEAR CONTRASEÑA

              

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