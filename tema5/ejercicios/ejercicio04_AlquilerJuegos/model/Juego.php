<?php

class Juego {
    private $codigo;
    private $nombre_juego;
    private $nombre_consola;
    private $anio;
    private $precio;
    private $alquilado;
    private $imagen;
    private $descripcion;
    
    public function __construct($codigo, $nombre_juego, $nombre_consola, $anio, $precio, $alquilado, $imagen, $descripcion) {
        $this->codigo = $codigo;
        $this->nombre_juego = $nombre_juego;
        $this->nombre_consola = $nombre_consola;
        $this->anio = $anio;
        $this->precio = $precio;
        $this->alquilado = $alquilado;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }

}

?>