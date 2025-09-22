<?php

use CriptografiaClassica\CriptografiaTransposicaoColunar;
use CriptografiaClassica\CriptografiaVigenere;
use CriptografiaClassica\CriptografiaDES;

require_once 'vendor/autoload.php';

$texto = readline('Digite o texto criptografado: ');
$chave = readline('Digite a chave: ');

validarEntrada($textoCriptografado, $chave);

$textoDescriptografado = descriptografar($textoCriptografado, $chave);

echo 'Texto criptografado: ' . $textoCriptografado . PHP_EOL;
echo 'Texto descriptografado: ' . $textoDescriptografado . PHP_EOL;

function descriptografar(string $texto, string $chave): string {
    $criptografiaTransposicaoColunar = new CriptografiaTransposicaoColunar();
    $criptografiaVigenere = new CriptografiaVigenere();
    $criptografiaDES = new CriptografiaDES();

    $textoDescriptografadoDES = $criptografiaDES->descriptografar($texto, $chave);
    $textoDescriptografadoVigenere = $criptografiaVigenere->descriptografar($textoDescriptografadoDES, $chave);
    $textoDescriptografadoTransposicao = $criptografiaTransposicaoColunar->descriptografar($textoDescriptografadoVigenere, $chave);

    return $textoDescriptografadoTransposicao;
}