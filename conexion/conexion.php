<?php
class ApptivaDB {
    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $db = "postulaciones";
    public $conexion;

    // private $host = "localhost";
    // private $usuario = "fundaci_pedidos";
    // private $clave = "pedidos.1379";
    // private $db = "fundaci_pedidos";
    // public $conexion;
    
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db)
        or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }

    public function loginVoluntario($usuario, $password) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE mail = '$usuario'") or die();
            return $resultado -> fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function loginPostulante($usuario, $password) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuarios WHERE dni = '$usuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarUsuarios($filtro, $buscador,  $inicio) {
        try {
            if ($filtro == "voluntarios") {
                $resultado = $this->conexion->query("SELECT id, nombre, apellido, dni, mail, habilitado, rol FROM usuariosnuevos WHERE rol != 'postulante' ORDER BY apellido limit 10 offset $inicio") or die();
            } else {
                $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.telefono, U.rol, U.pass, U.raven, U.ct, U.habilitado, U.asignado idAsignado, CONCAT(B.nombre, ' ',  B.apellido) asignado FROM usuariosnuevos U
                INNER JOIN usuariosnuevos B ON U.asignado = B.id  WHERE U.anio = '$filtro' AND U.rol = 'postulante' ORDER BY apellido limit 10 offset $inicio") or die();
            }
            // if ($buscador != "") {
            //     // $busqueda = '%' . $buscador . '%';
            //     // if ($idCategoria == 0) {
            //     // } else {
            //     //     $condicion = '%-' . $idCategoria . '-%';
            //     //     $resultado = $this->conexion->query("SELECT nombre, apellido, provincia, telefono, pass, raven, ct FROM usuariosNuevos WHERE categoria LIKE '$condicion' AND nombre LIKE '$busqueda' ORDER BY nombre limit 5 offset $inicio") or die();
            //     // }
            // } else {
            //     if ($idCategoria == 0) {
            //         $resultado = $this->conexion->query("SELECT nombre, apellido, provincia, telefono, pass, raven, ct FROM usuariosNuevos WHERE tipo = '$tipo' ORDER BY nombre limit 5 offset $inicio") or die();
            //     } else {
            //         $condicion = '%-' . $idCategoria . '-%';
            //         $resultado = $this->conexion->query("SELECT nombre, apellido, provincia, telefono, pass, raven, ct FROM usuariosNuevos WHERE categoria LIKE '$condicion' ORDER BY nombre limit 5 offset $inicio") or die();
            //     }
            // }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarVoluntarios() {
        try {
            $resultado = $this->conexion->query("SELECT id, CONCAT(nombre, ' ', apellido) voluntario FROM usuariosnuevos WHERE rol != 'postulante' AND habilitado = 1 ORDER BY apellido") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function insertarUsuario($datos) {
        try {
            $resultado = $this->conexion->query("INSERT INTO usuariosnuevos VALUES(null, $datos)") or die();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            return $th;
        }
    }

    public function eliminar($tabla, $condicion) {
        try {
            $resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }

    }

    public function asignarUsuario($idUsuario, $idVoluntario) {
        try {
            $resultado = $this->conexion->query("UPDATE usuariosnuevos SET asignado = '$idVoluntario' WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function editarUsuario($data, $idUsuario) {
        try {
            $resultado = $this->conexion->query("UPDATE usuariosnuevos SET $data WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function habilitarUsuario($id, $habilitado) {
        try {
            $resultado = $this->conexion->query("UPDATE usuariosnuevos SET habilitado = '$habilitado' WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function resetear($idUsuario, $contrasenia) {
        try {
            $resultado = $this->conexion->query("UPDATE usuariosnuevos SET pass = '$contrasenia' WHERE id = '$idUsuario'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hayRegistro($condicion) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuariosnuevos WHERE $condicion") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function validarMailExistente($condicion) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM usuariosnuevos WHERE $condicion") or die();
            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            $numero = count($resultado);
            return $numero;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function editarDni($id, $dni) {
        try {
            $resultado = $this->conexion->query("UPDATE usuariosnuevos SET dni = '$dni' WHERE id = '$id'") or die();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function contarUsuarios($filtro, $buscador) {
        try {
            if ($filtro == 'voluntarios') {
                $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuariosnuevos WHERE rol != 'postulante'");
            } else {
                $resultado = $this->conexion->query("SELECT COUNT(*) total FROM usuariosnuevos WHERE rol = 'postulante' AND anio LIKE '$filtro'");
            }

            // if ($filtro == "voluntarios") {
            //     $resultado = $this->conexion->query("SELECT id, nombre, apellido, dni, mail, habilitado, rol FROM usuariosnuevos WHERE rol != 'postulante' ORDER BY apellido limit 10 offset $inicio") or die();
            // } else {
            //     $resultado = $this->conexion->query("SELECT U.id, U.nombre, U.apellido, U.dni, U.provincia, U.telefono, U.rol, U.pass, U.raven, U.ct, U.habilitado, U.asignado idAsignado, CONCAT(B.nombre, ' ',  B.apellido) asignado FROM usuariosnuevos U
            //     INNER JOIN usuariosnuevos B ON U.asignado = B.id  WHERE U.anio = '$filtro' AND U.rol = 'postulante' ORDER BY apellido limit 10 offset $inicio") or die();
            // }
            // if ($idCategoria == 0) {
            //     $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'recurso'") or die();
            // } else {
            //     $condicion = '%-' . $idCategoria . '-%';
            //     $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'recurso' AND categoria LIKE '$condicion'") or die();
            // }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }






















    // public function insertar($tabla, $datos) {
    //     try {
    //         $resultado = $this->conexion->query("INSERT INTO $tabla VALUES(null, $datos)") or die();
    //         return true;
    //     } catch (\Throwable $th) {
    //         // return $th;
    //         return false;
    //     }
    // }

    public function consultarCategorias($tabla, $condicion) {
        try {
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion ORDER BY nombre ASC") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }
    // public function consultar($tabla, $condicion) {
    //     try {
    //         $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion ORDER BY nombre ASC") or die();
    //         return $resultado->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }



    // public function eliminar($tabla, $condicion) {
    //     try {
    //         $resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die();
    //         return true;
    //     } catch (\Throwable $th) {
    //         return false;
    //     }

    // }

    //   public function consultarCategorias($tabla, $condicion) {
    //     try {
    //         $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion ORDER BY nombre ASC") or die();
    //         return $resultado->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }


    public function consultar($tabla, $tipo, $idCategoria, $inicio) {
        try {
            if ($idCategoria == 0) {
                $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' ORDER BY nombre limit 5 offset $inicio") or die();
            } else {
                $condicion = '%-' . $idCategoria . '-%';
                $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND categoria LIKE '$condicion' ORDER BY nombre limit 5 offset $inicio") or die();
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarLibros($tabla, $tipo, $idCategoria, $buscador, $inicio) {
        try {
            if ($buscador != "") {
                $busqueda = '%' . $buscador . '%';
                if ($idCategoria == 0) {
                    $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND nombre LIKE '$busqueda' ORDER BY nombre limit 5 offset $inicio") or die();
                } else {
                    $condicion = '%-' . $idCategoria . '-%';
                    $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND categoria LIKE '$condicion' AND nombre LIKE '$busqueda' ORDER BY nombre limit 5 offset $inicio") or die();
                }
            } else {
                if ($idCategoria == 0) {
                    $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' ORDER BY nombre limit 5 offset $inicio") or die();
                } else {
                    $condicion = '%-' . $idCategoria . '-%';
                    $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND categoria LIKE '$condicion' ORDER BY nombre limit 5 offset $inicio") or die();
                }
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function contarLibros($idCategoria, $buscador) {
        try {
            if ($buscador != "") {
                $busqueda = '%' . $buscador . '%';
                if ($idCategoria == 0) {
                    // $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND nombre LIKE '$busqueda' ORDER BY nombre limit 5 offset $inicio") or die();
                    $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro' AND nombre LIKE '$busqueda'") or die();
                } else {
                    $condicion = '%-' . $idCategoria . '-%';
                    // $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE tipo = '$tipo' AND categoria LIKE '$condicion' AND nombre LIKE '$busqueda' ORDER BY nombre limit 5 offset $inicio") or die();
                    $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro' AND categoria AND nombre LIKE '$busqueda' LIKE '$condicion'") or die();
                }
            } else {
                if ($idCategoria == 0) {
                    $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro'") or die();
                } else {
                    $condicion = '%-' . $idCategoria . '-%';
                    $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro' AND categoria LIKE '$condicion'") or die();
                }
            }


            // if ($idCategoria == 0) {
            //     $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro'") or die();
            // } else {
            //     $condicion = '%-' . $idCategoria . '-%';
            //     $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'libro' AND categoria LIKE '$condicion'") or die();
            // }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarPlanificaciones($tabla, $idCategoria, $inicio) {
        try {
            if ($idCategoria == 0) {
                $resultado = $this->conexion->query("SELECT id, nombre, categoria, descripcion FROM $tabla WHERE tipo = 'planificaciones' ORDER BY nombre limit 5 offset $inicio") or die();
            } else {
                $condicion = '%-' . $idCategoria . '-%';
                $resultado = $this->conexion->query("SELECT id, nombre, categoria, descripcion FROM $tabla WHERE tipo = 'planificaciones' AND categoria LIKE '$condicion' ORDER BY nombre limit 5 offset $inicio") or die();
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function verPlanificacion($tabla, $condcion) {
        try {
            $resultado = $this->conexion->query("SELECT archivo FROM $tabla WHERE $condcion") or die();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function buscarPorCategoria($idCategoria) {
        try {
            if ($idCategoria == 0) {
                $resultado = $this->conexion->query("SELECT * FROM recursos WHERE tipo = 'libro'") or die();
            } else {
                $condicion = '%-' . $idCategoria . '-%';
                // $resultado = $this->conexion->query("SELECT * FROM libros WHERE categoria = $idCategoria") or die();
                $resultado = $this->conexion->query("SELECT * FROM recursos WHERE tipo = 'libro' AND categoria LIKE '$condicion'") or die();
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

    // public function contarRecursos($idCategoria) {
    //     try {
    //         if ($idCategoria == 0) {
    //             $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'recurso'") or die();
    //         } else {
    //             $condicion = '%-' . $idCategoria . '-%';
    //             $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'recurso' AND categoria LIKE '$condicion'") or die();
    //         }
    //         return $resultado->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }

    public function contarPlanificaciones($idCategoria) {
        try {
            if ($idCategoria == 0) {
                $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'planificaciones'") or die();
            } else {
                $condicion = '%-' . $idCategoria . '-%';
                $resultado = $this->conexion->query("SELECT COUNT(*) total FROM recursos WHERE tipo = 'planificaciones' AND categoria LIKE '$condicion'") or die();
            }
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

}

?>