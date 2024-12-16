<?php


interface Personaje {
    public function obtenerDescripcion(): string;
    public function obtenerPoder(): int;
}


abstract class PersonajeBase implements Personaje {
    protected $descripcion = "Personaje genérico";
    
    public function obtenerDescripcion(): string {
        return $this->descripcion;
    }

    abstract public function obtenerPoder(): int;
}


class Guerrero extends PersonajeBase {
    public function __construct() {
        $this->descripcion = "Guerrero";
    }

    public function obtenerPoder(): int {
        return 50;
    }
}

class Arquero extends PersonajeBase {
    public function __construct() {
        $this->descripcion = "Arquero";
    }

    public function obtenerPoder(): int {
        return 40;
    }
}

abstract class DecoradorArma implements Personaje {
    protected $personaje;

    public function __construct(Personaje $personaje) {
        $this->personaje = $personaje;
    }

    public function obtenerDescripcion(): string {
        return $this->personaje->obtenerDescripcion();
    }

    public function obtenerPoder(): int {
        return $this->personaje->obtenerPoder();
    }
}


class Espada extends DecoradorArma {
    public function obtenerDescripcion(): string {
        return parent::obtenerDescripcion() . " con Espada";
    }

    public function obtenerPoder(): int {
        return parent::obtenerPoder() + 20;
    }
}

class Arco extends DecoradorArma {
    public function obtenerDescripcion(): string {
        return parent::obtenerDescripcion() . " con Arco";
    }

    public function obtenerPoder(): int {
        return parent::obtenerPoder() + 15;
    }
}


$guerrero = new Guerrero();
$guerreroConEspada = new Espada($guerrero);

$arquero = new Arquero();
$arqueroConArco = new Arco($arquero);

echo "Personaje 1: " . $guerreroConEspada->obtenerDescripcion() . 
     " - Poder: " . $guerreroConEspada->obtenerPoder() . "\n";

echo "Personaje 2: " . $arqueroConArco->obtenerDescripcion() . 
     " - Poder: " . $arqueroConArco->obtenerPoder() . "\n";