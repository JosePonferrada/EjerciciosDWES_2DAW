<?php

require_once 'Conexion.php';
require_once '../model/Cliente.php';

class ControllerCliente {
    
    public static function getAll() {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from cliente");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $c = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->clave, $fila->tipo);
                    $clientes[] = $c;
                }
            } else {
                $clientes = false;
            }
            $conex->close();
            return $clientes;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
    public static function getClienteByDNI($dni) {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from cliente where DNI = '$dni'");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $c = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->clave, $fila->tipo);
                    $clientes[] = $c;
                }
            } else {
                $clientes = false;
            }
            $conex->close();
            return $clientes;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }


    public static function insertar(Cliente $c) {
        
        try {
            $conex = new Conexion();
            $pass = md5($c->clave);
            $conex->query("INSERT into cliente VALUES ('$c->DNI', '$c->Nombre', '$c->Apellidos', '$c->Direccion', '$c->Localidad', '$pass', 'cliente')");
            $filas = $conex->affected_rows ;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
}

?>