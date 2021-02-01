<?php
$senha = $_POST['senha'] ?? '';
if ($senha == 'tudocerto') {
    setcookie('autorizado', 1);
} else {
    setcookie('autorizado', 0);
}
header('location: index.php');
?>