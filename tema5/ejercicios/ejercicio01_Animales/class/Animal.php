<?php

class Animal {
    public $nombre;
    public $patas;
    public $anios;
    public $edadMedia;
    
    public function __construct($nombre, $patas, $anios, $edadMedia) {
        $this->nombre = $nombre;
        $this->patas = $patas;
        $this->anios = $anios;
        $this->edadMedia = $edadMedia;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return "Soy un animal llamado " . $this->nombre
                . ", tengo " . $this->patas
                . " patas, " . $this->anios
                . " años y mi edad media de vida es " . $this->edadMedia. " años";
    }
    
    public function come() {
        echo $this->nombre." está comiendo ahora mismo";
    }
    
}

?>