<?php


interface ArchivoWindows10 {
    public function abrirArchivoModerno(): string;
}

class ArchivoWindows7 {
    public function abrirArchivoAntiguo(): string {
        return "Archivo abierto en formato Windows 7";
    }
}

class AdaptadorArchivo implements ArchivoWindows10 {
    private $archivoAntiguo;

    public function __construct(ArchivoWindows7 $archivoAntiguo) {
        $this->archivoAntiguo = $archivoAntiguo;
    }

    public function abrirArchivoModerno(): string {
        return "Adaptando: " . $this->archivoAntiguo->abrirArchivoAntiguo() . 
               " a formato Windows 10";
    }
}

class SistemaOperativo {
    public function abrirArchivo(ArchivoWindows10 $archivo): void {
        echo $archivo->abrirArchivoModerno() . "\n";
    }
}

$sistemaWindows10 = new SistemaOperativo();

$archivoWord = new ArchivoWindows7();
$archivoExcel = new ArchivoWindows7();

$adaptadorWord = new AdaptadorArchivo($archivoWord);
$adaptadorExcel = new AdaptadorArchivo($archivoExcel);

$sistemaWindows10->abrirArchivo($adaptadorWord);
$sistemaWindows10->abrirArchivo($adaptadorExcel);