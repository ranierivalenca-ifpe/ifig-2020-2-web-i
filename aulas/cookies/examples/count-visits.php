<?php
$visits = $_COOKIE['visits'] ?? 0;
$visits++;
setcookie('visits', $visits);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Você já visitou esta página <?= $visits ?> vez(es)</h1>
</body>
</html>