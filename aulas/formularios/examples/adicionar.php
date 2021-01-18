<?php
$nome = $_POST['NOME'];
$sobre = $_POST['sobrenome'];
?>
<h2>Dados recebidos:</h2>
<ul>
    <li>Nome: <strong><?= $nome ?></strong></li>
    <li>Sobrenome: <strong><?= $sobre ?></strong></li>
</ul>

<?php

$fp = fopen('dados.csv', 'a');
fwrite($fp, $nome . ',' . $sobre . "\n");
fclose($fp);

?>

<a href="listar.php">Ver dados</a>
<a href="form-example.html">adicionar novo</a>