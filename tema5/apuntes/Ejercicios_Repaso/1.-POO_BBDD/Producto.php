<?php

require_once './conexion.php';

class Producto {
    private $codigo;
    private $nombre;
    private $precio;
    
    public function __construct($cod="", $nom="", $pre=0) {
        $this->codigo = $cod;
        $this->nombre = $nom;
        $this->precio = $pre;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function nuevoProducto($cod, $nom, $pre) {
        $this->codigo = $cod;
        $this->nombre = $nom;
        $this->precio = $pre;
    }
    
    public function __toString(): string {
        return "Código: " . $this->codigo
                . ", Nombre: " . $this->nombre
                . ", Precio: " . $this->precio
                . "€";
    }
    
    public function insertar() {
        try {
            $conex = new Conexion();
            $conex->query("INSERT into producto VALUES ('$this->codigo', '$this->nombre', $this->precio)");
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
                    $p = new self($fila->codigo, $fila->nombre, $fila->precio);
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
                $producto = new self($fila->codigo, $fila->nombre, $fila->precio);
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

