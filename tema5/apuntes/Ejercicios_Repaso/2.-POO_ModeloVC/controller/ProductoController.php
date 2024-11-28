<?php

require_once 'Conexion.php';
require_once '../model/Producto.php';

class ProductoController {
    
    public static function insertar(Producto $p) {
        
        try {
            $conex = new Conexion();
            $conex->query("INSERT into producto VALUES ('$p->codigo', '$p->nombre', '$p->precio')");
            $filas = $conex->affected_rows ;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
}

?>