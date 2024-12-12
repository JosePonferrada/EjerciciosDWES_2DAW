<?php

class Billete {
    private $dni;
    private $recorrido;
    private $hora;
    private $agencia;
    private $fecha;
    private $tipo;
    private $precio;
    private $img_tarjeta;
    
    public function __construct($dni, $recorrido, $hora, $agencia, $fecha, $tipo, $precio, $img_tarjeta) {
        $this->dni = $dni;
        $this->recorrido = $recorrido;
        $this->hora = $hora;
        $this->agencia = $agencia;
        $this->fecha = $fecha;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->img_tarjeta = $img_tarjeta;
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>