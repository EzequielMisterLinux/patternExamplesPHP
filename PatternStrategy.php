<?php


interface EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void;
}


class SalidaConsola implements EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void {
        echo "Salida Consola: $mensaje\n";
    }
}


class SalidaJSON implements EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void {
        $jsonOutput = json_encode(['mensaje' => $mensaje]);
        echo "Salida JSON: $jsonOutput\n";
    }
}


class SalidaArchivo implements EstrategiaSalida {
    private $archivo;

    public function __construct(string $nombreArchivo) {
        $this->archivo = $nombreArchivo;
    }

    public function mostrarMensaje(string $mensaje): void {
        file_put_contents($this->archivo, $mensaje . PHP_EOL, FILE_APPEND);
        echo "Mensaje guardado en archivo: {$this->archivo}\n";
    }
}


class MensajeSistema {
    private $estrategia;

    public function setEstrategia(EstrategiaSalida $estrategia): void {
        $this->estrategia = $estrategia;
    }

    public function mostrarMensaje(string $mensaje): void {
        $this->estrategia->mostrarMensaje($mensaje);
    }
}


$sistema = new MensajeSistema();


$sistema->setEstrategia(new SalidaConsola());
$sistema->mostrarMensaje("Mensaje de prueba en consola");


$sistema->setEstrategia(new SalidaJSON());
$sistema->mostrarMensaje("Mensaje de prueba en JSON");

$sistema->setEstrategia(new SalidaArchivo("salida.txt"));
$sistema->mostrarMensaje("Mensaje de prueba en archivo de texto");