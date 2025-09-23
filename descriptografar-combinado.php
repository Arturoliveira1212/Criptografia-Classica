<?php

use CriptografiaClassica\CriptografiaTransposicaoColunar;
use CriptografiaClassica\CriptografiaVigenere;
use CriptografiaClassica\CriptografiaDES;

require_once 'vendor/autoload.php';

try {
    $textoCriptografado = readline('Digite o texto criptografado: ');
    $chave = readline('Digite a chave: ');

    $textoDescriptografado = descriptografar($textoCriptografado, $chave);
    echo 'Texto descriptografado: ' . $textoDescriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível descriptografar o texto. Verifique se o texto e a chave estão corretos.' . PHP_EOL;
    die();
}

function descriptografar(string $texto, string $chave): string {
    $criptografiaTransposicaoColunar = new CriptografiaTransposicaoColunar();
    $criptografiaVigenere = new CriptografiaVigenere();
    $criptografiaDES = new CriptografiaDES();

    $textoDescriptografadoDES = $criptografiaDES->descriptografar($texto, $chave);
    $textoDescriptografadoVigenere = $criptografiaVigenere->descriptografar($textoDescriptografadoDES, $chave);
    $textoDescriptografadoTransposicao = $criptografiaTransposicaoColunar->descriptografar($textoDescriptografadoVigenere, $chave);

    return $textoDescriptografadoTransposicao;
}