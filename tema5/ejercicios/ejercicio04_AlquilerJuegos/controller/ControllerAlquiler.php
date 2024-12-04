<?php

require_once 'Conexion.php';
require_once '../model/Alquiler.php';

class ControllerAlquiler {
    
    public static function insertar(Alquiler $a) {
        
        try {
            $conex = new Conexion();
            $conex->query("INSERT into alquiler VALUES ('$a->id', '$a->Cod_juego', '$a->DNI_cliente', '$a->Fecha_alquiler', '$a->Fecha_devol', '$a->precio')");
            $filas = $conex->affected_rows ;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
}

?>