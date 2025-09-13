<?php

namespace CriptografiaClassica;

interface Criptografia {
    public function criptografar(string $texto, string $chave): string;
    public function descriptografar(string $texto, string $chave): string;
}
