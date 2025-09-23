<?php

use CriptografiaClassica\CriptografiaDES;

require_once 'vendor/autoload.php';

try {
    $textoCriptografado = readline('Digite o texto criptografado (DES): ');
    $chave = readline('Digite a chave: ');

    $criptografiaDES = new CriptografiaDES();
    $textoDescriptografado = $criptografiaDES->descriptografar($textoCriptografado, $chave);
    echo 'Texto descriptografado (DES): ' . $textoDescriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível descriptografar o texto. Verifique se o texto criptografado e a chave estão corretos.' . PHP_EOL;
    die();
}