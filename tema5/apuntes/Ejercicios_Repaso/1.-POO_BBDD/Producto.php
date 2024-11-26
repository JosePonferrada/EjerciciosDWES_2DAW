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
    
}

