<?php

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
        return $this->$name;
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
    
}



?>