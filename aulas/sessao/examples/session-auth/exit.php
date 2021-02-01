<?php
session_start();

// session_destroy();
unset($_SESSION['autorizado']);

header('location: index.php');
?>