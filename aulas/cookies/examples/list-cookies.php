<?php
echo "<pre>";
foreach($_COOKIE as $name => $value) {
    echo $name . " = " . $value . PHP_EOL;
}
echo "</pre>";
?>