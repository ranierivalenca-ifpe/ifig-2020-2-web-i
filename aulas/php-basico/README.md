# Introdução ao PHP e Servidor embutido do PHP

## PHP

**PHP** é tanto uma *linguagem de programação* quando uma *aplicação* utilizada para interpretar scripts que são escritos nesta linguagem.

A documentação do PHP está disponível **[aqui](https://www.php.net/manual/pt_BR/index.php)**.

## Servidor PHP embutido

O PHP, a partir da versão 5.4 (a versão atual do PHP é a 7.3.25 ou a 7.4.13 ou a 8.0.0 (recém lançada)), tem um *servidor web embutido*, que permite a disponibilização de scripts e arquivos utilizando o protocolo http, geralmente para fins de teste.

Para iniciar este servidor, basta entrar num diretório (qualquer um) pelo terminal e digitar o comando `php -S localhost:8000`. Isso irá iniciar um servidor web na porta `8000`, escutando apenas requests vindos de `localhost`. Note o parâmetro `-S` escrito em letra *maiúscula*. Para mudar a porta, basta trocar o `8000` por qualquer valor entre 1024 e 65535. Para o servidor escutar requests vindos de qualquer máquina na rede, utilize `0.0.0.0` no lugar de `localhost`.

A documentação sobre este servidor está disponível **[aqui](https://www.php.net/manual/pt_BR/features.commandline.webserver.php)**.

# Sintaxe básica do PHP

Antes de falar sobre a sintaxe básica do PHP, vale salientar alguns detalhes sobre como o PHP funciona no modelo cliente-servidor.

Como sabe-se, o PHP possui um [servidor embutido](https://www.php.net/manual/pt_BR/features.commandline.webserver.php), que utiliza a pasta atual como raiz. Para utilizá-lo, basta executar o comando `php -S localhost:8000`, como já explicado anteriormente.

Este servidor tem como comportamento padrão servir os arquivos requisitados da forma como estão no disco. Isto funciona para a maioria dos arquivos, com algumas exceções. Uma dessas exceções, e a mais importante delas é para os que possuem a extensão `.php`. Para estes arquivos, o servidor embutido de PHP (assim como servidores PHP em geral), antes de enviá-lo, esses arquivos são **interpretados**. De forma simplória, é como se, internamente, o servidor estivesse executando o comando `php arquivo-requisitado.php`, e enviando no response *apenas o que é escrito por esta execução*.

## Hello World e variáveis

Antes do primeiro exemplo, vale salientar um detalhe extremamente importante. O PHP interpreta **apenas** o código que estiver entre os delimitadores de código PHP, `<?php` e `?>`. Tudo que estiver fora destes delimitadores será escrito da forma como está.

Agora, veja o exemplo a seguir:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello world</title>
</head>
<body>
    <?php echo "hello world"; ?>
</body>
</html>
```

Todo o código HTML neste exemplo será retornado naturalmente, exceto o código `<?php echo "hello world"; ?>`. Este código será interpretado, e seu retorno será simplesmente a string `"hello world"`. O comando `echo` do PHP serve para escrever uma string ou o conteúdo de uma variável:
```php
<?php
    $nome = 'ranieri';
    echo 'o professor é ' . $nome;
?>
```

Neste outro exemplo, pode-se ver a utilização de variáveis e o processo de concatenação de strings. Apesar de PHP, similar a JavaScript, ser uma linguagem *C-like* (ou seja, uma linguagem com sintaxe similar à sintaxe de C), e as operações matemáticas e de atribuição, assim como os blocos de código e estruturas de controle, serem similares, algumas diferenças importantes devem ser notadas.

Primeiro, **o nome de qualquer variável inicia com o símbolo `$`**. Após o `$`, segue-se a regra normal de linguagens *C-like* (primeiro caractere precisa ser uma letra ou `_` e os caracteres seguintes podem ser letras, números ou `_`). Outra diferença importante é o **operador de concatenação de PHP ser o caractere `.`**.

Além disso, em importante salientar que em PHP strings podem ser descritas entre aspas simples (`''`) ou aspas duplas (`""`) (há ainda outros detalhes sobre strings, que podem ser vistos [aqui](https://www.php.net/manual/pt_BR/language.types.string.php)). A diferença basicamente consiste no fato de que strings delimitadas por aspas duplas *tentam interpretar variáveis que estejam dentro delas* (similar às strings delimitadas por acento grave (\`\`) no JavaScript), enquanto strings delimitadas por aspas simples não. Então, o exemplo a seguir tem o mesmo resultado que o anterior:
```php
<?php
    $nome = 'ranieri';
    echo "o professor é $nome";
?>
```

## Estruturas de controle

Como já falado, as estruturas de controle em PHP são similares a outras linguagens:
```php
<ul>
<?php
    for ($i = 0; $i < 10; $i++) {
        if ($i == 5) {
            echo "<li><strong>$i</strong></li>";
        } else {
            echo '<li>' . $i . '</li>';
        }
    }
?>
</ul>
```

Mas esta sintaxe traz um problema ao PHP quando integrado ao HTML (função para o qual foi desenvolvido): o código HTML fica misturado ao PHP, dentro de strings, diminuindo drasticamente a *manutenibilidade* do código. Assim, para resolver este problema, o PHP traz uma sintaxe alternativa, que permite que blocos de código HTML sejam separados de blocos de código PHP. No exemplo a seguir, o HTML resultante será **o mesmo do exemplo anterior**, exceto por alguns espaços extras:
```php
<ul>
    <?php for ($i = 0; $i < 10; $i++): ?>
        <?php if ($i == 5): ?>
            <li>
                <strong><?= $i ?></strong>
            </li>
        <?php else: ?>
            <li>
                <?= $i ?>
            </li>
        <?php endif ?>
    <?php endfor ?>
</ul>
```

Note neste exemplo também o uso da sintaxe `<?= $i ?>`. Esta é uma outra sintaxe abreviada dos delimitadores de PHP, que é a mesma coisa que `<?php echo $i; ?>`, para facilitar a escrita de variáveis dentro de códigos HTML.

## Arrays em PHP

Em PHP, arrays podem ser declarados usando a função `array()` ou utilizando os tradicionais colchetes (`[]`). O exemplo a seguir declara dois arrays, nas duas sintaxes:
```php
<?php
    $gastos = array(
        'combustível', // índice 0
        'diária',      // índice 1
        'almoço',      // índice 2
        'jantar'       // índice 3
    );

    $valores = [
        200, // índice 0
        200, // índice 1
        100, // índice 2
        120  // índice 3
    ];
?>
<h1>Gastos com a viagem</h1>
<h2>Tipos</h2>
<ul>
    <?php for ($i = 0; $i < sizeof($gastos); $i++): ?>
        <li><?= $gastos[$i] ?></li>
    <?php endfor ?>
</ul>
<h2>Valores</h2>
<ul>
    <?php foreach ($valores as $valor): ?>
        <li><?= $valor ?></li>
    <?php endforeach ?>
</ul>
```

O exemplo anterior mostra também como é possível *ler* os dados de um array, utilizando os operadores `[]`, e como contar o número de elementos de um array, utilizando a função `sizeof()` (funções serão melhor descritas a seguir). Neste exemplo também é mostrada a estrutura de controle **`foreach`**, extremamente importante no PHP. O `foreach` substitui, de certa forma, o `for`, na medida que lê cada elemento do array e coloca-o dentro de uma variável. No exemplo, cada um dos valores dentro da variável `$valores` é colocado na variável `$valor`, que existe dentro do contexto da estrutura de controle. Os dois exemplos a seguir geram exatamente o mesmo resultado:
```php
<?php
$numeros = [1, 1, 2, 3, 5, 8];

for ($i = 0; $i < sizeof($numeros); $i++) {
    $numero = $numeros[$i];
    echo "[$numero]";
}
echo PHP_EOL; // imprime uma linha em branco
foreach($numeros as $numero) {
    echo "[$numero]";
}

 ?>
```

Neste caso, o `foreach` terá um comportamento bastante similar ao `for` apresentado, criando uma variável `$numero` para cada elemento do array `$numeros`.

PHP também aceita arrays *indexados*, onde os índices podem ser inteiros ou strings. Para declarar um array indexado, utilizamos o operador `=>`, conforme o exemplo a seguir:
```php
<?php
    $herois = [
        'Iron Main' => 'Tony Esterco',
        'Hook' => 'Bruce Gancho',
        'Gavião Roqueiro' => 'Clin Tim Barton'
    ];

    echo "<ul>";
    foreach ($herois as $nomeDeHeroi => $nomeReal) {
        echo "<li>$nomeReal é $nomeDeHeroi</li>";
    }
    echo "</ul>";
?>
```

Neste exemplo vemos também como `foreach` pode ser utilizado para navegar por arrays indexados, tendo acesso também ao seu índice. A cada iteração do `foreach`, o índice é colocado na variável `$nomeDeHeroi` o valor respectivo é colocado na variável `$nomeReal`.

## Verificando o conteúdo de variáveis

A função `echo` é utilizada para escrever o conteúdo de variáveis, mas é diferente da função `console.log()` do JavaScript. Enquanto esta escreve o conteúdo de qualquer tipo de dados, a função `echo` escreve apenas o conteúdo de tipos de dados simples:
```php
<?php
$string = 'nome';
$numero = 1101;
$float = 1.92;
$array = [1, 1, 2, 3, 5, 8, 11];

echo $string . PHP_EOL; // imprime "nome\n" =)
echo $numero . PHP_EOL; // imprime "1101\n" =)
echo $float . PHP_EOL; // imprime "1.92\n" =)
echo $array . PHP_EOL; // imprime "array\n"  =(
?>
```

Para escrever o conteúdo de arrays e objetos, podemos utilizar as funções `print_r()` ou `var_dump()`:
```php
<?php
$array = [1, 1, 2, 3, 5, 8, 11];

print_r($array);
/*
Array
(
    [0] => 1
    [1] => 1
    [2] => 2
    [3] => 3
    [4] => 5
    [5] => 8
    [6] => 11
)
*/

var_dump($array);
/*
array(7) {
  [0]=>
  int(1)
  [1]=>
  int(1)
  [2]=>
  int(2)
  [3]=>
  int(3)
  [4]=>
  int(5)
  [5]=>
  int(8)
  [6]=>
  int(11)
}
*/
?>
```

Enquanto `print_r()` imprime os dados de uma forma mais simplificada e mais fácil de ser entendida, ela dá menos detalhes sobre o conteúdo do array. Por isso, é importante ter ciência da função `var_dump()` e de como utilizá-la.

# Referências e mais conteúdos

Para saber mais sobre os tópicos aqui explanados e **muito mais**, consulte a documentação do PHP, nos links abaixo:
- https://www.php.net/manual/pt_BR/language.basic-syntax.php
- https://www.php.net/manual/pt_BR/language.types.php
- https://www.php.net/manual/pt_BR/language.variables.php
- https://www.php.net/manual/pt_BR/language.expressions.php
- https://www.php.net/manual/pt_BR/language.operators.arithmetic.php
- https://www.php.net/manual/pt_BR/language.operators.comparison.php
- https://www.php.net/manual/pt_BR/language.operators.string.php
- https://www.php.net/manual/pt_BR/language.operators.array.php
- https://www.php.net/manual/pt_BR/language.control-structures.php
- https://www.php.net/manual/pt_BR/language.types.array.php
