# Incluindo outros arquivos

É possível adicionar um arquivo *"dentro"* de um script PHP, incluindo-o através das estruturas de controle [`include`](https://www.php.net/manual/pt_BR/function.include.php), [`require`](https://www.php.net/manual/pt_BR/function.require.php), [`include_once`](https://www.php.net/manual/pt_BR/function.include_once.php) ou [`require_once`](https://www.php.net/manual/pt_BR/function.require_once.php).

Quando um arquivo é incluído em um script PHP ele é interpretado como sendo um código PHP. Ou seja, se for um texto plano ou um conteúdo HTML, ele será simplesmente lançado na saída padrão como qualquer outro texto ou código HTML que fosse escrito fora das tags delimitadoras do PHP (`<php ... ?>`).

Por outro lado, se o arquivo incluído possuir tags código em PHP (ou seja, entre as tags delimitadoras), então tal código será interpretado e considerado parte do código que está incluindo.

Veja o exemplo abaixo:

##### header.html
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
```

##### footer.html
```html
</body>
</html>
```

##### funcoes.php
```php
<?php
define('FILENAME', 'data.csv');

function get_data($id = null) {
    $data = file(FILENAME);
    $data = array_map('str_getcsv', $data);
    if (is_null($id) || !isset($data[$id])) {
        return $data;
    }
    return $data[$id];
}
?>
```

##### index.php
```php
<?php include 'header.html' ?>
<?php
require 'funcoes.php';
$data = get_data();
?>
<table>
    <?php foreach ($data as $item): ?>
        <tr><!-- ... --></tr>
    <?php endforeach ?>
</table>
<?php include 'footer.html' ?>
```

Neste exemplo, a `index.php` contém basicamente o *corpo* da página, enquanto o conteúdo do cabeçalho e do rodapé do HTML fica definido em outros arquivos.

Também neste exemplo é possível ver uma boa prática para o uso de constantes. A constante `FILENAME` está definida em um arquivo (`funcoes.php`) que deve ser incluído em todos os outros scripts que precisarem acessar este arquivo. Assim, caso seja necessário mudar o nome do arquivo onde as informações são lidas e escritas, basta mudar em um único lugar.

Geralmente em programação é uma boa prática manter códigos que podem ser alterados (nomes de arquivos, caminhos de sites, porta de uma aplicação, versão de um sistema, regra de negócio, etc) em um único lugar, e tudo que depender deste trecho de código deve importá-lo. No caso do PHP, esta importação é através de alguma das estruturas de controle anteriormente citadas.

Sobre as diferenças entre as formas de incluir um arquivo, veja abaixo:
- `include ...;` - inclui um arquivo e o interpreta; caso o arquivo não exista, gera um alerta mas ainda continua a execução do script.
- `require ...;` - o mesmo que o `include`, mas quando o arquivo não existe o PHP gera um erro e encerra a execução do script.
- `include_once ...;` - o mesmo que o `include`, exceto pelo fato de que caso o arquivo já tenha sido incluído, não inclui novamente.
- `require_once ...;` - mesmo que o `require`, exceto pelo fato de que caso o arquivo já tenha sido incluído, não inclui novamente.

Em resumo:

| Comando | Arquivo não existe | Verifica se já foi incluído |
| --- | --- | --- |
| `include` | alerta | não |
| `require` | erro | não |
| `include_once` | alerta | sim |
| `require_once` | erro | sim |

# Referências e mais conteúdos

- http://excript.com/php/importacao-include-require-php.html
- https://pt.stackoverflow.com/questions/15286/o-que-usar-require-include-require-once-include-once