<?php

use CriptografiaClassica\CriptografiaTransposicaoColunar;
use CriptografiaClassica\CriptografiaVigenere;
use CriptografiaClassica\CriptografiaDES;

require_once 'vendor/autoload.php';

$texto = readline('Digite o texto: ');
$chave = readline('Digite a chave: ');

validarEntrada($texto, $chave);

$textoCriptografado = criptografar($texto, $chave);

echo 'Texto original: ' . $texto . PHP_EOL;
echo 'Texto criptografado: ' . $textoCriptografado . PHP_EOL;

function validarEntrada(string $texto, string $chave): void {
    if (empty($texto) || empty($chave)) {
        die('O texto e a chave não podem estar vazios.' . PHP_EOL);
    }

    if (!contemApenasLetras($texto) || !contemApenasLetras($chave)) {
        die('O texto e a chave devem conter apenas letras.' . PHP_EOL);
    }
}

function contemApenasLetras(string $texto): bool {
    return preg_match('/^[a-zA-Z ]+$/', $texto) === 1;
}

function criptografar(string $texto, string $chave): string {
    $criptografiaTransposicaoColunar = new CriptografiaTransposicaoColunar();
    $criptografiaVigenere = new CriptografiaVigenere();
    $criptografiaDES = new CriptografiaDES();

    $textoCriptografadoTransposicao = $criptografiaTransposicaoColunar->criptografar($texto, $chave);
    $textoCriptografadoVigenere = $criptografiaVigenere->criptografar($textoCriptografadoTransposicao, $chave);
    $textoCriptografadoDES = $criptografiaDES->criptografar($textoCriptografadoVigenere, $chave);

    return $textoCriptografadoDES;
}
