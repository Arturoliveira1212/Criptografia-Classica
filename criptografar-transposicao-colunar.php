<?php

use CriptografiaClassica\CriptografiaTransposicaoColunar;

require_once 'vendor/autoload.php';

try {
    $texto = readline('Digite o texto: ');
    $chave = readline('Digite a chave: ');
    validarEntrada($texto, $chave);

    $criptografiaTransposicaoColunar = new CriptografiaTransposicaoColunar();
    $textoCriptografado = $criptografiaTransposicaoColunar->criptografar($texto, $chave);
    echo 'Texto criptografado (Transposição Colunar): ' . $textoCriptografado . PHP_EOL;
} catch (Throwable $th) {
    echo 'Não foi possível criptografar o texto. Verifique se o texto e a chave estão corretos.' . PHP_EOL;
    die();
}

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