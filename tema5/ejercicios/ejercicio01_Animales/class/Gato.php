<?php

require_once './Mamifero.php';

class Gato extends Mamifero {
    private $tamaniobigotes;
    
    public function __construct($nombre, $patas, $anios, $edadMedia, $sexo, $tamaniobigotes) {
        parent::__construct($nombre, $patas, $anios, $edadMedia, $sexo);
        $this->tamaniobigotes = $tamaniobigotes;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return parent::__toString().", además tengo unos bigotes ".$this->tamaniobigotes;
    }
    
    public function colarse() {
        echo $this->nombre." se ha colado en otra casa ajena";
    }
    
    public function subirArbol() {
        echo $this->nombre." se ha subido a un árbol";
    }
    
    public function maullar() {
        echo $this->nombre." está maullando";
    }
    
}

?>