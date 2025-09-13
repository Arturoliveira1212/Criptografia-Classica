<?php

namespace CriptografiaClassica;

class CriptografiaVigenere implements Criptografia {
    const LETRA_MORTA = '#';
    const ESPACO = '@';

    private function gerarAlfabeto(): array {
        $alfabeto = range('A', 'Z');
        $alfabeto[] = self::ESPACO;
        $alfabeto[] = self::LETRA_MORTA;

        return $alfabeto;
    }

    public function criptografar(string $texto, string $chave): string {
        $alfabeto = $this->gerarAlfabeto();
        $resultado = $this->obterTextoCriptografado($texto, $chave, $alfabeto);

        return $resultado;
    }

    private function obterTextoCriptografado(string $texto, string $chave, array $alfabeto): string {
        $resultado = '';
        $tamanhoAlfabeto = count($alfabeto);

        $texto = strtoupper($texto);
        $chave = strtoupper($chave);

        $tamanhoTexto = mb_strlen($texto);
        $tamanhoChave = mb_strlen($chave);

        $j = 0;

        for ($i = 0; $i < $tamanhoTexto; $i++) {
            $letra = $texto[$i];
            $letraChave = $chave[$j % $tamanhoChave];

            $posicaoTexto = array_search($letra, $alfabeto);
            $posicaoChave = array_search($letraChave, $alfabeto);

            $letraNaoEstaNoAlfabeto = $posicaoTexto === false;
            if ($letraNaoEstaNoAlfabeto) {
                $resultado .= $letra;
            } else {
                $novaPosicao = ($posicaoTexto + $posicaoChave) % $tamanhoAlfabeto;
                $resultado .= $alfabeto[$novaPosicao];
            }

            $j++;
        }

        return $resultado;
    }

    public function descriptografar(string $texto, string $chave): string {
        return '';
    }
}