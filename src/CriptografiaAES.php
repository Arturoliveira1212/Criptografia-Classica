<?php

namespace CriptografiaClassica;

class CriptografiaAES implements Criptografia {
    private const CIPHER_METHOD = 'AES-256-CBC';

    public function criptografar(string $texto, string $chave): string {
        $chaveAjustada = $this->ajustarChave($chave);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::CIPHER_METHOD));

        $textoCriptografado = openssl_encrypt(
            $texto,
            self::CIPHER_METHOD,
            $chaveAjustada,
            0,
            $iv
        );

        if ($textoCriptografado === false) {
            throw new \Exception('Erro ao criptografar o texto com AES');
        }

        return base64_encode($iv . $textoCriptografado);
    }

    public function descriptografar(string $texto, string $chave): string {
        $chaveAjustada = $this->ajustarChave($chave);
        $textoDecodificado = base64_decode($texto);
        $ivLength = openssl_cipher_iv_length(self::CIPHER_METHOD);
        $iv = substr($textoDecodificado, 0, $ivLength);
        $textoCifrado = substr($textoDecodificado, $ivLength);

        $textoDescriptografado = openssl_decrypt(
            $textoCifrado,
            self::CIPHER_METHOD,
            $chaveAjustada,
            0,
            $iv
        );

        if ($textoDescriptografado === false) {
            throw new \Exception('Erro ao descriptografar o texto com AES');
        }

        return $textoDescriptografado;
    }

    private function ajustarChave(string $chave): string {
        return hash('sha256', $chave, true);
    }
}