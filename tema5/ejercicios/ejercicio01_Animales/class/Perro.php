<?php

require_once './Mamifero.php';

class Perro extends Mamifero {
    private $color;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $sexo, $color) {
        parent::__construct($nombre, $patas, $anios, $edadMedia, $sexo);
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
    
    public function ladrar() {
        echo $this->nombre." no para de ladrar";
    }
    
}

?>