<?php

use CriptografiaClassica\CriptografiaAES;

require_once 'vendor/autoload.php';

try {
    $texto = readline('Digite o texto: ');
    $chave = readline('Digite a chave: ');

    $criptografiaAES = new CriptografiaAES();
    $textoCriptografado = $criptografiaAES->criptografar($texto, $chave);
    echo 'Texto criptografado (AES): ' . $textoCriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível criptografar o texto. Verifique se o texto e a chave estão corretos.' . PHP_EOL;
    die();
}