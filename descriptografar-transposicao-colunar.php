<?php

use CriptografiaClassica\CriptografiaTransposicaoColunar;

require_once 'vendor/autoload.php';

try {
    $textoCriptografado = readline('Digite o texto criptografado (Transposição Colunar): ');
    $chave = readline('Digite a chave: ');
    validarEntrada($textoCriptografado, $chave);

    $criptografiaTransposicaoColunar = new CriptografiaTransposicaoColunar();
    $textoDescriptografado = $criptografiaTransposicaoColunar->descriptografar($textoCriptografado, $chave);

    echo 'Texto descriptografado (Transposição Colunar): ' . $textoDescriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível descriptografar o texto. Verifique se o texto criptografado e a chave estão corretos.' . PHP_EOL;
    die();
}

function validarEntrada(string $texto, string $chave): void {
    if (empty($texto) || empty($chave)) {
        die('O texto e a chave não podem estar vazios.' . PHP_EOL);
    }

    if (!contemApenasLetrasESimbolos($chave)) {
        die('A chave deve conter apenas letras.' . PHP_EOL);
    }
}

function contemApenasLetrasESimbolos(string $texto): bool {
    return preg_match('/^[a-zA-Z]+$/', $texto) === 1;
}