<?php

use CriptografiaClassica\CriptografiaAES;

require_once 'vendor/autoload.php';

try {
    $textoCriptografado = readline('Digite o texto criptografado (AES): ');
    $chave = readline('Digite a chave: ');

    $criptografiaAES = new CriptografiaAES();
    $textoDescriptografado = $criptografiaAES->descriptografar($textoCriptografado, $chave);
    echo 'Texto descriptografado (AES): ' . $textoDescriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível descriptografar o texto. Verifique se o texto criptografado e a chave estão corretos.' . PHP_EOL;
    die();
}