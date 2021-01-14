# Técnicas para manipulação de arquivos

Como já mostrado anteriormente, para manipular arquivos em PHP (e em basicamente qualquer outra linguagem de programação) é preciso de um *manipulador* de arquivo. Em PHP, esse manipulador é uma variável do tipo *resource*, retornada por uma chamada à função `fopen()`.

A seguir, serão descritas algumas técnicas que podem ser utilizadas para trabalhar com arquivos em PHP.

### Lendo o arquivo inteiro

As formas mais simples de se ler o conteúdo de um arquivo são através das funções `file_get_contents()`, que retornará *todo o conteúdo do arquivo como uma **string***, e através da função `file()`, que colocará cada linha do arquivo em um elemento de um array (incluindo o caractere `\n` (e possivelmente o `\r`)).

Outra forma de ler o conteúdo de um arquivo, linha a linha, é através da função `fgets()`, para a qual deve ser passado um manipulador de arquivo (aberto no modo `r` através da função `fopen()`). Esta função irá ler uma linha do arquivo (incluindo o caractere de quebra de linha), e irá mover o *ponteiro* do manipulador para o início da próxima linha (o conceito de ponteiro neste contexto será explicado adiante). Quando o ponteiro está no final do arquivo, a função retornará o valor booleano `false`. Observe o exemplo a seguir:

```php
<?php
$fp = fopen('arquivo.txt', 'r');
$linha = fgets($fp); // lê a primeira linha do arquivo
while($linha !== false) {
    echo $linha . '<br>';
    $linha = fgets($fp); // lê a próxima linha do arquivo
}

// Poderia ser escrito também desta forma abaixo. Se não entender, procure o professor =)
/* while(($linha = fgets($fp)) !== false) {
    echo $linha;
} */
?>
```

Note neste exemplo o operador `!==`. Este é um operador de **não identidade**, já que PHP diferencia *igualdade* (valores são iguais) de *identidade* (valores E tipos são iguais). Assim, o operador de identidade é `===`. Para mais informações, consulte a [documentação do PHP sobre comparações](https://www.php.net/manual/pt_BR/language.operators.comparison.php), já referenciada em uma aula anterior, ou [esta referência mais rápida sobre operadores em PHP](https://www.w3schools.com/php/php_operators.asp).

### Escrevendo uma linha no final de um arquivo

Para escrever apenas uma linha num arquivo qualquer, é preciso abri-lo com a função [`fopen()`](https://www.php.net/manual/pt_BR/function.fopen.php) utilizando o modo `a`. Note que este modo é diferente do modo `w` ("*write*"); enquanto este abre o arquivo e **zera seu conteúdo** (ou seja, apaga todo o seu conteúdo), o modo `a` vai abrir o arquivo **mantendo o seu conteúdo** e colocando o **ponteiro** no final do arquivo.

O conceito de *ponteiro* neste contexto é bastante similar ao cursor em um editor de texto - o cursor indica em qual ponto do arquivo será inserido aquilo que é digitado. Porém, quando se trata de manipulação de arquivos em um programa, o cursor pode ser utilizado tanto para leitura quanto para escrita, e tudo que é escrito *sobrescreve* o que estava anteriormente (exceto quando o ponteiro está no final do arquivo - nesse caso, o que for escrito será *adicionado* ao arquivo). Observe o exemplo a seguir:

```php
<?php
// ...
$fp = fopen('arquivo.txt', 'w'); // se o arquivo já existir, seu conteúdo será apagado
fwrite($fp, "um texto qualquer\n"); // escreve 'um texto qualquer' dentro do arquivo; note o uso de aspas duplas delimitar a string - em PHP, strings com aspas simples NÃO INTERPRETAM CARACTERES ESCAPADOS
fclose($fp);

// ...

$fp = fopen('arquivo.txt', 'a'); // se o arquivo já existir, abre e coloca o cursor no final do arquivo, mantendo o seu conteúdo
fwrite($fp, "outro texto qualquer\n");
fclose($fp);
// ...
?>
```

### Escrevendo uma linha no meio de um arquivo (sem sobrescrever o conteúdo)

Escrever uma linha no meio de um arquivo é um processo um pouco mais complexo, que envolve a *reescrita de todo o conteúdo do arquivo*. Na verdade isso pode ser um pouco otimizado ([veja esta pergunta no Stack Overflow](https://stackoverflow.com/questions/16813457/php-what-is-the-best-way-to-write-data-to-middle-of-file-without-rewriting-file)), mais ainda assim é um processo mais trabalhoso.

Utilizado a abordagem de reescrever o conteúdo do arquivo, a forma mais simples de fazer isso é utilizando o processo a seguir:
- ler o arquivo para um array;
- inserir um elemento no array na posição desejada (lembrando de colocar a quebra de linha ao final do conteúdo deste elemento);
- transformar o array para uma string através da função `implode()` (ou da forma que preferir);
- sobrescrever o arquivo com esta nova string.

Veja os exemplos a seguir:
```php
<?php
$linhas = file('arquivo.txt');
$linhas[] = "uma nova linha\n"; // inserindo no final do array, ou seja, no final do arquivo

$conteudo = implode('', $linhas); // note que a "cola" é uma string vazia, já que cada linha possui sua própria quebra de linha (lembre do comportamento da função 'file')

file_put_contents('arquivo.txt', $conteudo);
?>
```

```php
<?php
$linhas = file('arquivo.txt');

$novaLinha = "uma linha no meio do arquivo\n";

$conteudo = ''; // isso será parecido com o algoritmo de soma de elementos de um array
foreach($linhas as $indice => $linha) {
    // $conteudo = $conteudo . $linha;
    $conteudo .= $linha; // cada linha do array (linha do arquivo) é adicionada ao conteúdo...
    if ($indice == 1) { // mas após o índice 1 (segunda linha)...
        $conteudo .= $novaLinha; // a nova linha é inserida
    }
}

file_put_contents('arquivo.txt', $conteudo);
?>
```

### Apagando uma linha de um arquivo

Assim como escrever uma linha no meio de um arquivo, apagar uma parte de um arquivo também envolve a reescrita de todo o arquivo. O processo é exatamente o mesmo, exceto que para apagar uma linha é possível simplesmente remover o elemento do array antes de transformá-lo em string, através da função `unset()`. Caso queira manter uma linha em branco, basta substituir seu conteúdo por uma quebra de linha:
```php
<?php
$linhas = file('arquivo.txt');

$linhaParaApagar = 2;

$linhas[$linhaParaApagar] = "\n";

file_put_contents('arquivo.txt', implode('', $linhas));
?>
```
#Referências

- https://phpenthusiast.com/blog/parse-csv-with-php
