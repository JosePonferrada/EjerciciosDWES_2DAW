<?php

require_once 'Animal.php';

class Ave extends Animal {
    protected $tipoPico;
    protected $tipoAlas;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $tipoPico, $tipoAlas) {
        parent::__construct($nombre, $patas, $anios, $edadMedia);
        $this->tipoPico = $tipoPico;
        $this->tipoAlas = $tipoAlas;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString()." y tengo un pico ".$this->tipoPico." y unas alas ".$this->tipoAlas;
    }
    
    public function volar() {
        echo $this->nombre." está volando";
    }
    
    public function alimentar() {
        echo $this->nombre." está alimentando a sus crías";
    }
    
    public function escapar() {
        echo $this->nombre." está escapando de una amenaza";
    }
    
}

?>