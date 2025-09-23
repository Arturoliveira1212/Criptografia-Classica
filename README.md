# Criptografia Clássica

Este projeto implementa algoritmos de criptografia clássica em PHP.

## Desenvolvedores
- Artur Alves
- Guilherme Rosa

## Requisitos
- PHP 8.0 ou superior
- Composer

## Instalação
1. Instale as dependências do projeto executando:
	```bash
	composer install
	composer dump-autoload
	```

## Como executar
O projeto oferece scripts específicos para cada algoritmo de criptografia:

### Criptografia
```bash
php criptografar-aes.php          # Criptografia AES-256-CBC
php criptografar-des.php          # Criptografia DES
php criptografar-vigenere.php     # Cifra de Vigenère
php criptografar-transposicao-colunar.php  # Transposição Colunar
```

### Descriptografia
```bash
php descriptografar-aes.php       # Descriptografia AES-256-CBC
php descriptografar-des.php       # Descriptografia DES
php descriptografar-vigenere.php  # Decifra de Vigenère
php descriptografar-transposicao-colunar.php  # Descriptografia Transposição Colunar
```

### Script Combinado
```bash
php criptografar-combinado.php    # Múltiplos algoritmos em sequência
php descriptografar-combinado.php # Descriptografia do texto combinado
```

Cada script solicita o texto a ser processado e a chave correspondente.

## Observações
- Aceitamos no texto enviado apenas caracteres alfabéticos (A-Z, a-z), sem cedilha (ç) ou caracteres especiais, exceto o espaço (' ').