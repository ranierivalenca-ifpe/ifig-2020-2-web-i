<?php

$fp = fopen('arquivo.txt', 'w');
fwrite($fp, "Hello world\n");
fwrite($fp, "You are cruel\n");
fclose($fp);

?>