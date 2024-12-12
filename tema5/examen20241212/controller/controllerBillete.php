<?php
require_once '../controller/Conexion.php';
require_once '../model/billete.php';

class controllerBillete {
    
    public static function getAll() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM billete");
            if ($result->rowCount()) {
                while($fila = $result->fetch_object()) {
                $billete = new Billete($fila->dni, $fila->recorrido, $fila->hora, $fila->agencia, $fila->fecha, $fila->tipo, $fila->precio, $fila->img_tarjeta);
                $billetes[] = $billete;
                }
            } else {
                $billetes = false;
            }
            $conex->close();
            return $billetes;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
}

?>