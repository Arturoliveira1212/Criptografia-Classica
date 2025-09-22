<?php

namespace CriptografiaClassica;

use Exception;

class CriptografiaDES implements Criptografia {
    private const CIPHER_METHOD = 'DES-EDE-ECB';

    public function criptografar(string $texto, string $chave): string {
        $chaveAjustada = $this->ajustarChave($chave);

        $textoCriptografado = openssl_encrypt(
            $texto,
            self::CIPHER_METHOD,
            $chaveAjustada
        );

        if ($textoCriptografado === false) {
            throw new Exception('Erro ao criptografar o texto com DES');
        }

        return $textoCriptografado;
    }

    public function descriptografar(string $texto, string $chave): string {
        $chaveAjustada = $this->ajustarChave($chave);

        $textoDescriptografado = openssl_decrypt(
            $texto,
            self::CIPHER_METHOD,
            $chaveAjustada
        );

        if ($textoDescriptografado === false) {
            throw new Exception('Erro ao descriptografar o texto com DES');
        }

        return $textoDescriptografado;
    }

    private function ajustarChave(string $chave): string {
        $tamanhoChave = mb_strlen($chave);

        if ($tamanhoChave < 8) {
            // Completa com zeros à direita se a chave for muito pequena
            return str_pad($chave, 8, "\0");
        } elseif ($tamanhoChave > 8) {
            // Trunca se a chave for muito grande
            return substr($chave, 0, 8);
        }

        return $chave;
    }
}