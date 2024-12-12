<?php

require_once 'Conexion.php';
require_once '../model/cliente';

class controllerCliente {

    public static function getAll() {

        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM cliente");
            if ($result->rowCount()) {
                $fila = $result->fetch_object();
                $cliente = new Cliente($fila->dni, $fila->nombre, $fila->apellidos, $fila->telf);
            } else {
                $cliente = false;
            }
            $conex->close();
            return $cliente;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
    public static function getClienteByDni($dni) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM cliente WHERE dni = '$dni'");
            if ($result->rowCount()) {
                $fila = $result->fetch_object();
                $cliente = new Cliente($fila->dni, $fila->nombre, $fila->apellidos, $fila->telf);
            } else {
                $cliente = false;
            }
            $conex->close();
            return $cliente;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
    
}

?>