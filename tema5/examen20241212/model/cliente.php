<?php

class Cliente {
    private $dni;
    private $nombre;
    private $apellidos;
    private $telf;
    
    public function __construct($dni, $nombre, $apellidos, $telf) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telf = $telf;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>