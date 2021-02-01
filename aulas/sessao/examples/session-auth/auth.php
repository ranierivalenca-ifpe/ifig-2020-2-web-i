<?php
session_start();

$senha = $_POST['senha'] ?? '';
if ($senha == 'tudocerto') {
    $_SESSION['autorizado'] = true;
}
header('location: index.php');
?>