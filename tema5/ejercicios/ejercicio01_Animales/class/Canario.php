<?php

require_once './Ave.php';

class Canario extends Ave {
    private $color;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $tipoPico, $tipoAlas, $color) {
        parent::__construct($nombre, $patas, $anios, $edadMedia, $tipoPico, $tipoAlas);
        $this->color = $color;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString().", además soy de color ".$this->color;
    }
    
    public function canta() {
        echo $this->nombre. " está cantando";
    }
    
}

?>