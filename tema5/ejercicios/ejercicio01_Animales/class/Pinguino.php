<?php

require_once './Ave.php';

class Pinguino extends Ave {
    private $profesion;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $tipoPico, $tipoAlas, $profesion) {
        parent::__construct($nombre, $patas, $anios, $edadMedia, $tipoPico, $tipoAlas);
        $this->profesion = $profesion;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString().", y soy ".$this->profesion;
    }
    
    public function deslizarse() {
        echo $this->nombre." se ha puesto a deslizarse sobre su barriga";
    }
    
}

?>