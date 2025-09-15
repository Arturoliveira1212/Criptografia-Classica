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
        $chave = $this->gerarChaveEmArray(strtoupper($chave));
        $numeroColunas = count($chave);
        $numeroLinhas = ceil(strlen($texto) / $numeroColunas);

        $matriz = $this->criarMatrizParaDescriptografar(
            $texto, $numeroLinhas, $numeroColunas, $chave
        );

        $resultado = $this->obterTextoDescriptografado(
            $matriz, $numeroLinhas, $numeroColunas
        );

        return $resultado;
    }

    private function criarMatrizParaDescriptografar(string $texto, int $numeroLinhas, int $numeroColunas, array $chave): array {
        $matriz = [];

        $indice = 0;
        for ($i = 1; $i <= $numeroColunas; $i++) {
            $coluna = array_search($i, $chave);
            for ($linha = 0; $linha < $numeroLinhas; $linha++) {
                $matriz[$linha][$coluna] = $texto[$indice++];
            }
        }

        return $matriz;
    }

    private function obterTextoDescriptografado(array $matriz, int $numeroLinhas, int $numeroColunas): string {
        $resultado = '';

        for ($linha = 0; $linha < $numeroLinhas; $linha++) {
            for ($coluna = 0; $coluna < $numeroColunas; $coluna++) {
                $resultado .= $matriz[$linha][$coluna];
            }
        }

        $resultado = str_replace(self::ESPACO, ' ', $resultado);
        $resultado = str_replace(self::LETRA_MORTA, '', $resultado);

        return $resultado;
    }
}