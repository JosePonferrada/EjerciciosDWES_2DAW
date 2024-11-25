<?php

require_once 'Animal.php';

class Mamifero extends Animal {
    protected $sexo;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $sexo) {
        parent::__construct($nombre, $patas, $anios, $edadMedia);
        $this->sexo = $sexo;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString()." y soy un/a ".$this->sexo;
    }
    
    public function camina() {
        echo $this->nombre." está caminando ahora mismo";
    }
    
    public function duerme() {
        echo $this->nombre." está durmiendo ahora mismo";
    }
    
}

?>