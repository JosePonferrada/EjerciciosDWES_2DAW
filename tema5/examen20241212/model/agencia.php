<?php

class Agencia {
    private $nombre;
    private $telf;
    private $usuario;
    private $pass;
    
    public function __construct($nombre, $telf, $usuario, $pass) {
        $this->nombre = $nombre;
        $this->telf = $telf;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>