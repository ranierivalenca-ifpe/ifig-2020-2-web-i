<?php

$fp = FOpen('arquivo.txt', 'r');
// for ($i = 0; $i < 3; $i++) fgets($fp);
$primeira_linha = fgets($fp);

var_dump($primeira_linha);

?>