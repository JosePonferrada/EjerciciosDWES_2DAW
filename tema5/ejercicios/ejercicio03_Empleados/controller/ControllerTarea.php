<?php

require_once 'conexion.php';
require_once '../model/tarea.php';

class ControllerTarea {
    
    /**
     * 
     * @param Tarea $t
     * @return mixed
     */
    public static function insertar(Tarea $t): mixed {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO tareas (nombre,fecha_inicio,fecha_fin) VALUES ('$t->nombre','$t->fecha_inicio','$t->fecha_fin')");
            if ($conex->affected_rows > 0) {
                // Obtiene el ID de la tarea recién creada
                $id_tarea = $conex->insert_id;
            }
            $conex->close();
            return $id_tarea;
        } catch (Exception $ex) {
            die("ERROR EN LA BD! => " . $ex->getMessage());
        }
    }
    
    /**
     * 
     * @param type $id
     * @return bool
     */
    public static function findById($id): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM tareas WHERE id = '$id'");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $tarea = new Tarea($fila->id, $fila->nombre, $fila->fecha_inicio, $fila->fecha_fin);
            } else {
                $tarea = false;
            }
            $conex->close();
            return $tarea;
        } catch (Exception $ex) {
            die("ERROR en la BD! => ".$ex->getMessage());
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM tareas");
            if ($result->num_rows) {
                while($fila = $result->fetch_object()) {
                    $tarea = new Tarea($fila->id, $fila->nombre, $fila->fecha_inicio, $fila->fecha_fin);
                    // Guardamos en array.
                    $tareas[] = $tarea;
                }
            } else {
                $tareas = false;
            }
            // Cerramos la conexión.
            $conex->close();
            // Devolvemos el resultado.
            return $tareas;
        } catch (Exception $ex) {
            die("ERROR en la BD! => ".$ex->getMessage());
        }
    }
}

?>