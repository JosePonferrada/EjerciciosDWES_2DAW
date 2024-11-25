<?php

require_once './Animal.php';

class Lagarto extends Animal {
    private $tamanioLengua;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $tamanioLengua) {
        parent::__construct($nombre, $patas, $anios, $edadMedia);
        $this->tamanioLengua = $tamanioLengua;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString().", y tengo una lengua ".$this->tamanioLengua;
    }
    
    public function cazar() {
        echo $this->nombre." ha cazado una mosca";
    }
    
}

?>