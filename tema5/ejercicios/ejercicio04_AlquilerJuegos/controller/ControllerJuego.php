<?php

require_once 'conexion.php';
require_once '../model/juego.php';

class ControllerJuego {

    /**
     * 
     * @param type $dni_cliente
     * @return bool
     */
    public static function getJuegosNoAlquiladosByCliente($dni_cliente) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos WHERE Codigo NOT IN (SELECT Cod_juego
                FROM alquiler WHERE DNI_cliente = '$dni_cliente')");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $juego;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }

    /**
     * 
     * @return bool
     */
    public static function getJuegosNoAlquilados() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos WHERE Alguilado = 'NO'");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $juego;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $cod_juego
     * @return type
     */
    public static function liberarJuego($cod_juego) {
        try {
            $conex = new Conexion();
            $result = $conex->query("UPDATE juegos SET Alguilado = 'NO' WHERE Codigo = '$cod_juego'");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $nombre_juego
     * @param type $nombre_consola
     * @return string
     */
    public static function generateCodigoJuego($nombre_juego, $nombre_consola) {
        // Obtenemos las palabras del nombre.
        $palabras = explode(' ', $nombre_juego);
        $siglas = "";

        // Recorremos cada palabra y guardamos la primera letra.
        foreach ($palabras as $palabra) {
            $siglas .= $palabra[0];
        }

        // Concatenamos las siglas con el nombre de la consola.
        $codigo_juego = $siglas . '-' . $nombre_consola;

        // Devolvemos el código.
        return $codigo_juego;
    }

    /**
     * 
     * @param type $id_registro
     * @param Juego $j
     * @return mixed
     */
    public static function updateJuego($id_registro, Juego $j): mixed {
        try {
            $conex = new Conexion();
            $conex->query("UPDATE juegos SET Nombre_juego='$j->nombre_juego',Nombre_consola='$j->nombre_consola',Anno='$j->anio',Precio='$j->precio',Alguilado='$j->alquilado',Imagen='$j->imagen',descripcion='$j->descripcion'"
                    . " WHERE Codigo = '$id_registro'");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! => " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $codigo
     * @return mixed
     */
    public static function deleteJuego($codigo): mixed {
        try {
            $conex = new Conexion();
            $conex->query("DELETE FROM juegos WHERE Codigo = '$codigo'");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! => " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param Juego $j
     * @return mixed
     */
    public static function insertJuego(Juego $j): mixed {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO juegos VALUES ('$j->codigo','$j->nombre_juego','$j->nombre_consola','$j->anio',$j->precio,'$j->alquilado','$j->imagen','$j->descripcion')");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! => " . $ex->getMessage());
        }
    }

    /**
     * 
     * @param type $cod_juego
     * @return bool
     */
    public static function rentJuego($cod_juego) {
        try {
            $conex = new Conexion();
            $result = $conex->query("UPDATE juegos SET Alguilado = 'SI' WHERE Codigo = '$cod_juego'");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function getJuegoById($id) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM juegos WHERE Codigo = ?");
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $fila = $result->fetch_object();
                $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
            } else {
                $juego = false;
            }
            $stmt->close();
            $conex->close();
            return $juego;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }

    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $juego = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $juego;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
}

?>