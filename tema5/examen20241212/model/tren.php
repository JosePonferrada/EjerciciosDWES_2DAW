<?php

class Tren {
    private $recorrido;
    private $hora;
    private $precio_tourist;
    
    public function __construct($recorrido, $hora, $precio_tourist) {
        $this->recorrido = $recorrido;
        $this->hora = $hora;
        $this->precio_tourist = $precio_tourist;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>