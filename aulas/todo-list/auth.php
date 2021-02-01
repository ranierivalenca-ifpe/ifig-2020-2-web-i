<?php

require 'init.php';

$username = $_POST['username'];
$password = sha1($_POST['password']);

$users = file(USERS_FILE) ?? [];
foreach($users as $raw_user) {
    $line = $username . ',' . $password;
    if (trim($raw_user) == $line) {
        $_SESSION['user'] = explode(',', $raw_user)[0];
        header('location: /');
        exit();
    }
}

header('location: login.php?error=Usuário ou senha incorreto');


?>