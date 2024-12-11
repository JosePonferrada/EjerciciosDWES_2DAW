<?php

require_once 'conexion.php';
require_once '../model/alquiler.php';

class ControllerAlquiler {
    
    /**
     * 
     * @param Alquiler $a
     * @param type $precio
     * @return type
     */
    public static function devolverJuego($id_alquiler, $precio) {
        // Fecha actual.
        $fecha = date("Y-m-d");
        try {
            $conex = new Conexion();
            $result = $conex->query("UPDATE alquiler SET Fecha_devol = '$fecha', Precio='$precio'"
                    . "WHERE id = $id_alquiler");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * 
     * @param type $dni_cliente
     * @return bool
     */
    public static function getAlquileresActivosByCliente($dni_cliente) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alquiler WHERE DNI_cliente = '$dni_cliente' AND Fecha_devol IS NULL");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $a = new Alquiler($fila->id, $fila->Cod_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol, $fila->Precio);
                    $alquiler[] = $a;
                }
            } else {
                $alquiler = false;
            }
            $conex->close();
            return $alquiler;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
    /**
     * 
     * @param type $cod_juego
     * @param type $dni_cliente
     * @return bool
     */
    public static function insertAlquiler($cod_juego, $dni_cliente) {
        // Fecha actual.
        $fecha = date("Y-m-d");
        try {
            $conex = new Conexion();
            $result = $conex->query("INSERT INTO alquiler(cod_juego,dni_cliente,fecha_alquiler) VALUES ('$cod_juego','$dni_cliente','$fecha')");
            $filas = $conex->affected_rows;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Devuelve un registro Alquiler según el código de un juego.
     * El juego debe seguir alquilado, es decir, fecha devolución es null.
     * @param type $cod_juego
     * @return bool
     */
    public static function getAlquilerByJuegoAlquilado($cod_juego) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alquiler WHERE Cod_juego = '$cod_juego' AND Fecha_devol IS NULL");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $alquiler = new Alquiler($fila->id, $fila->Cod_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol, $fila->Precio);
            } else {
                $alquiler = false;
            }
            $conex->close();
            return $alquiler;
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
            $result = $conex->query("SELECT * FROM alquiler");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $a = new Alquiler($fila->id, $fila->Cod_juego, $fila->DNI_cliente, $fila->Fecha_alquiler, $fila->Fecha_devol, $fila->Precio);
                    $alquiler[] = $a;
                }
            } else {
                $alquiler = false;
            }
            $conex->close();
            return $alquiler;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
}

?>