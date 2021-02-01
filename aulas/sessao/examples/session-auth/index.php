<?php
session_start();

$autorizado = $_SESSION['autorizado'] ?? false;
if ($autorizado !== true) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Sorria, você está autorizado a acessar esta página =)</h1>
    <a href="exit.php">sair</a>
</body>
</html>