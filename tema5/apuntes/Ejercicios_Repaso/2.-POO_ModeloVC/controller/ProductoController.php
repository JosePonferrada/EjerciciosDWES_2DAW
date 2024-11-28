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
    
    public static function recuperarTodos() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * from producto");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    // Guardamos el producto en un array, pero no guardamos $fila, guardamos un 
                    // objeto de la clase Producto para mantener la funcionalidad
                    // Como ya estamos en la clase producto no usamos new Producto, usamos new self()
                    $p = new Producto($fila->codigo, $fila->nombre, $fila->precio);
                    $productos[] = $p;
                }
            } else {
                $productos = false;
            }
            $conex->close();
            return $productos;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
    }
    
    public static function buscaProducto($codigo) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * from producto where codigo = '$codigo'");
            if ($result->num_rows) {
                $fila = $result->fetch_object();
                $producto = new Producto($fila->codigo, $fila->nombre, $fila->precio);
            } else {
                $producto = false;
            }
            $conex->close();
            return $producto;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
    }
    
}

?>