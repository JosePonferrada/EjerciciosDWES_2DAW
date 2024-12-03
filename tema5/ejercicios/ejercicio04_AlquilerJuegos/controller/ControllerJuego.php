<?php

require_once 'Conexion.php';
require_once '../model/Juego.php';

class ControllerJuego {
    
    public static function getAll() {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from juegos");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $j = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $j;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
    public static function getJuegoByName($nombreJuego) {
        
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from juegos where Nombre_juego = '$nombreJuego'");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $j = new Juego($fila->Codigo, $fila->Nombre_juego, $fila->Nombre_consola, $fila->Anno, $fila->Precio, $fila->Alguilado, $fila->Imagen, $fila->descripcion);
                    $juegos[] = $j;
                }
            } else {
                $juegos = false;
            }
            $conex->close();
            return $juegos;
            
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }


    public static function insertar(Juego $j) {
        
        try {
            $conex = new Conexion();
            $conex->query("INSERT into juegos VALUES ('$j->Codigo', '$J->Nombre_juego', '$j->Nombre_consola', '$j->Anno', '$j->Precio', '$j->Alguilado', '$j->Imagen', '$j->descripcion')");
            $filas = $conex->affected_rows ;
            $conex->close();
            return $filas;
        } catch (Exception $ex) {
            die("ERROR en la BBDD ".$ex->getMessage());
        }
        
    }
    
}

?>