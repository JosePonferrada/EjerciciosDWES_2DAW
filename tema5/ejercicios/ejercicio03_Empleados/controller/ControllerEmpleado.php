<?php

require_once 'Conexion.php';
require_once '../model/Empleado.php';

class ControllerEmpleado {
    
    public static function insertar(Empleado $e) {
        
        try {
            $conex = new Conexion();
            $pass = md5($e->pass);
            $conex->query("INSERT into empleados VALUES ('$e->email', '$pass', '$e->nombre', '$e->salario', '$e->dep')");
            $filas = $conex->affected_rows ;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
    public static function getAll() {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from empleados");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $e = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->dep);
                    $empleados[] = $e;
                }
            } else {
                $empleados = false;
            }
            $conex->close();
            return $empleados;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
    public static function getEmpleadoByNombre($nombre) {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from empleados where nombre = '$nombre'");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $e = new Empleado($fila->email, $fila->pass, $fila->nombre, $fila->salario, $fila->dep);
                    $empleados[] = $e;
                }
            } else {
                $empleados = false;
            }
            $conex->close();
            return $empleados;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
}

?>