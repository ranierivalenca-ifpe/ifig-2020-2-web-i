<pre>
<?php

$linha = $_GET['linha'];

$funcionarios = file('func.csv');
var_dump($funcionarios);

unset($funcionarios[$linha]);

echo "--\n";

var_dump($funcionarios);

$novo_conteudo = implode('', $funcionarios);

echo "--\n";

var_dump($novo_conteudo);

file_put_contents('func.csv', $novo_conteudo);

//header('location: index.php');

?>
</pre>
<a href="index.php">Voltar</a>