<?php

namespace CriptografiaClassica;

class CriptografiaTransposicaoColunar implements Criptografia {
    const LETRA_MORTA = '#';
    const ESPACO = '@';

    private function gerarChaveEmArray(string $chave): array {
        $letras = str_split($chave);
        $letrasOrdenadas = $letras;
        sort($letrasOrdenadas);

        $chave = [];
        foreach ($letras as $letra) {
            $posicao = array_search($letra, $letrasOrdenadas);
            $chave[] = $posicao + 1;

            unset($letrasOrdenadas[$posicao]);
        }

        return $chave;
    }

    public function criptografar(string $texto, string $chave): string {
        $texto = strtoupper($texto);
        $chave = $this->gerarChaveEmArray(strtoupper($chave));

        $tamanhoTexto = mb_strlen($texto);
        $numeroColunas = count($chave);
        $numeroLinhas = ceil($tamanhoTexto / $numeroColunas);

        $matriz = $this->criarMatrizParaCriptografar(
            $texto, $numeroLinhas, $numeroColunas, $tamanhoTexto
        );

        $resultado = $this->obterTextoCriptografado(
            $matriz, $chave, $numeroLinhas, $numeroColunas
        );

        return $resultado;
    }

    private function criarMatrizParaCriptografar(string $texto, int $numeroLinhas, int $numeroColunas, int $tamanhoTexto): array {
        $matriz = [];

        $indice = 0;
        for ($linha = 0; $linha < $numeroLinhas; $linha++) {
            for ($coluna = 0; $coluna < $numeroColunas; $coluna++) {
                if ($indice < $tamanhoTexto) {
                    $matriz[$linha][$coluna] = $texto[$indice] == ' ' ? self::ESPACO : $texto[$indice];
                    $indice++;
                } else {
                    $matriz[$linha][$coluna] = self::LETRA_MORTA;
                }
            }
        }

        return $matriz;
    }

    private function obterTextoCriptografado(array $matriz, array $chave, int $numeroLinhas, int $numeroColunas): string {
        $resultado = '';

        for ($i = 1; $i <= $numeroColunas; $i++) {
            $coluna = array_search($i, $chave);
            for ($linha = 0; $linha < $numeroLinhas; $linha++) {
                $resultado .= $matriz[$linha][$coluna];
            }
        }

        return $resultado;
    }

    public function descriptografar(string $texto, string $chave): string {
        return '';
    }
}