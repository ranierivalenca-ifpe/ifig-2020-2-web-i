<?php

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];

// $line = $cpf . ',' . $nome . ',' . $sobrenome . ',' . $email . "\n";
$line = implode(',', [$cpf, $nome, $sobrenome, $email]) . "\n";

$fp = fopen('func.csv', 'a');
fwrite($fp, $line);
fclose($fp);

header('location: index.php');

?>
