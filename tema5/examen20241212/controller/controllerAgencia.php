<?php

require_once '../controller/Conexion.php';
require_once '../model/agencia.php';

class controllerAgencia {
    
    public static function getAgenciaByUsu($usuario) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM agencia WHERE usuario = '$usuario'" );
            if ($result->rowCount()) {
                $fila = $result->fetchObject();
                $agencia = new Agencia($fila->nombre, $fila->telf, $fila->usuario, $fila->pass);
            } else {
                $agencia = false;
            }
            return $agencia;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
    public static function isAgenciaValid($agencia, $clave) {
        
        if ($agencia->pass == $clave) {
            return true;
        }
        return false;
        
    }
    
}

?>