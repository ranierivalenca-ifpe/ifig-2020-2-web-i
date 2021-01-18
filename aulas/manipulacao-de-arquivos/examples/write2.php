<?php

$fp = fopen('arquivo.txt', 'a');
fwrite($fp, "Outra linha\n");
fclose($fp);

?>