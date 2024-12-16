<?php


interface Personaje {
    public function atacar(): string;
    public function getVelocidad(): int;
}

class Esqueleto implements Personaje {
    public function atacar(): string {
        return "Ataque de Esqueleto con huesos";
    }

    public function getVelocidad(): int {
        return 5; 
    }
}

class Zombi implements Personaje {
    public function atacar(): string {
        return "Ataque de Zombi con mordisco";
    }

    public function getVelocidad(): int {
        return 3; 
    }
}

class PersonajeFactory {
    public static function crearPersonaje(string $nivel): Personaje {
        switch ($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombi();
            default:
                throw new Exception("Nivel de juego no válido");
        }
    }
}

function jugar($nivel) {
    try {
        $personaje = PersonajeFactory::crearPersonaje($nivel);
        echo "Nivel: $nivel\n";
        echo "Personaje creado: " . get_class($personaje) . "\n";
        echo "Ataque: " . $personaje->atacar() . "\n";
        echo "Velocidad: " . $personaje->getVelocidad() . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


jugar('facil');
echo "\n";
jugar('dificil');